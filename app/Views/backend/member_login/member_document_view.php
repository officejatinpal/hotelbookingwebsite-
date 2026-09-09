<!DOCTYPE html>
<html lang="en">
<head>
    <title>Member Document</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <style>
        .pdf-frame{
            width: 100%;
            height: 75vh; /* Big responsive height */
            border: 1px solid #ddd;
            border-radius: 6px;
            background: #fff;
        }
        .pdf-card{
            border: 1px solid #e5e5e5;
            border-radius: 6px;
            background: #fff;
            overflow: hidden;
        }
        .pdf-name{
            font-size: 14px;
            word-break: break-all;
        }
    </style>
</head>
<body>

<?php include 'profile_header.php'; ?>

<?php
$hasDocument = false;

if (!empty($documents)) {
    foreach ($documents as $doc) {
        if (
            isset($doc['document']) &&
            strtolower(pathinfo($doc['document'], PATHINFO_EXTENSION)) === 'pdf'
        ) {
            $hasDocument = true;
            break;
        }
    }
}
?>

<!-- DASHBOARD -->
<section class="holiday">
    <div class="db">
        <?php include 'profile_sidebar.php'; ?>

        <div class="db-2">
            <div class="db-2-com db-2-main">
                <h4>Membership Agreement</h4>

                <?php if ($hasDocument): ?>
                <div class="row g-4">

                    <?php foreach ($documents as $doc): ?>
                        <?php
                        if (
                            empty($doc['document']) ||
                            strtolower(pathinfo($doc['document'], PATHINFO_EXTENSION)) !== 'pdf'
                        ) continue;

                        $fileUrl = base_url('uploads/member_documents/' . $doc['document']);
                        ?>

                        <div class="col-lg-12">
                            <div class="pdf-card p-3 mb-4">

                                <!-- BIG PDF PREVIEW -->
                                <iframe 
                                    src="<?= $fileUrl; ?>" 
                                    class="pdf-frame">
                                </iframe>

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="pdf-name">
                                        <?= esc($doc['document']); ?>
                                    </div>

                                    <a href="<?= $fileUrl; ?>" 
                                       target="_blank" 
                                       class="btn btn-primary btn-sm">
                                        Open PDF
                                    </a>
                                </div>

                            </div>
                        </div>

                    <?php endforeach; ?>

                </div>
                <?php else: ?>
                    <div class="alert alert-info mt-3">
                        No PDF document available
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>
<!-- END DASHBOARD -->

</body>
</html>
