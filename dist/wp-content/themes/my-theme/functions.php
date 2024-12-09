<?php
$files = [
    'constants.php',
    'functions/init.php',
    'functions/admin.php',
    'functions/head.php',
    'functions/media.php',
    'functions/utils.php',
    'functions/custom-post-type.php',
    'functions/rest-api.php',
];

foreach ($files as $file) {
    locate_template($file, true, true);
}
