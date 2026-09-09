<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 Page Not Found | Delvia Holidays International</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <link href="<?= base_url('asset/css/bootstrap.min.css') ?>" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }
        .error-box {
            min-height: 100vh;
        }
    </style>
</head>
<body>

<div class="container error-box d-flex align-items-center justify-content-center">
    <div class="text-center">

        <h1 class="display-1 fw-bold text-primary">404</h1>
        <h3 class="mb-3">Page Not Found</h3>

        <p class="text-muted mb-4">
            Sorry, the page you are looking for does not exist or check spelling mistake.
        </p>

        <a href="<?= base_url() ?>" class="btn btn-primary px-4">
            Go to Home
        </a>

    </div>
</div>

</body>
</html>
