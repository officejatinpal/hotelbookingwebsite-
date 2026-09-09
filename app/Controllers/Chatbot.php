<?php

namespace App\Controllers;
use App\Models\ChatbotModel;

class Chatbot extends BaseController
{
    public function getResponse()
    {
        // ✅ Get message
        $msg = strtolower(trim($this->request->getPost('message')));

        // ✅ Stop words remove (SAFE WAY)
        $stopWords = ['what','is','the','how','can','i','please','tell','me','a','an','to','for','of','in','on','my','want','bro','sir'];

        $words = explode(' ', $msg);
        $filtered = [];

        foreach($words as $word){
            if(!in_array($word, $stopWords)){
                $filtered[] = $word;
            }
        }

        $msg = implode(' ', $filtered);

        // ✅ Clean extra spaces
        $msg = preg_replace('/\s+/', ' ', $msg);
        $msg = trim($msg);

        $model = new ChatbotModel();
        $allData = $model->findAll();

        $bestMatch = null;
        $maxScore = 0;

        foreach($allData as $row){

            $keywords = explode(',', strtolower($row['keywords']));
            $score = 0;

            foreach($keywords as $keyword){

                $keyword = trim($keyword);

                // ✅ Exact match (HIGH priority)
                if($msg === $keyword){
                    $score += 3;
                }

                // ✅ Word match
                elseif(preg_match('/\b'.preg_quote($keyword, '/').'\b/', $msg)){
                    $score += 2;
                }

                // ✅ Partial match
                elseif(preg_match('/\b'.preg_quote($keyword, '/').'\b/', $msg)){
                    $score += 2;
                }
            }

            // ✅ Best match pick karo
            if($score > $maxScore){
                $maxScore = $score;
                $bestMatch = $row['answer'];
            }
        }

        // ✅ Final response
        if($bestMatch){
            return $this->response->setJSON([
                'reply' => $bestMatch
            ]);
        }

        return $this->response->setJSON([
            'reply' => 'Sorry, I didn’t understand. Please contact support'
        ]);
    }
}