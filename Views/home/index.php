<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= public_dir('/assets/images/favicon.png') ?>" type="image/x-icon">
    <title>PGW - BD</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>

    <div class="w-full h-dvh flex justify-center items-center">
        <div class="flex justify-center items-center gap-4">
            <form action="" method="post">
                <button type="submit" name="bkash_paynow" class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer">Bkash Pay Now</button>
            </form>
            <form action="" method="post">
                <button type="submit" name="nagad_paynow" class="rounded-md bg-indigo-500 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer">Nagad Pay Now</button>
            </form>
        </div>
    </div>

</body>

</html>