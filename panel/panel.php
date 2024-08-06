<!DOCTYPE html>
<html>
    <head>
        <title>pgsl Admin Panel</title>
    </head>
    <body>
        <?php
        // get the decryption key from the form
        if (isset($_POST['key'])) {
            $encryptionKey = trim($_POST['key']);
        } else {
            die('No key provided.');
        }
        
        // function to decrypt the password
        function decrypt($encrypted, $key) {
            $encrypted = str_replace(["\n", "\r"], '', $encrypted);
            return openssl_decrypt(base64_decode($encrypted), 'aes-256-cbc', $key, OPENSSL_RAW_DATA, str_repeat('0', 16));
            }
        
        // known value of the password (to compare against)
        $knownPassword = 'POLWf/R8GgdudD54yKc4sT1v4RwRWRqeAyCF4L5+5So=';
        
        // encrypted password
        $encryptedPassword = 'U2FsdGVkX1+i+d7jStOvsdgGc/FYccr5O6aLV2RsAk5TM7cGTzb7Jz8KhEus9Mqz
        wejbXI0mnnxLhhbwUcGNVw==';
        
        // attempt to decrypt
        $decryptedPassword = decrypt($encryptedPassword, $encryptionKey);
        
        if ($knownPassword == $decryptedPassword):
        ?>
        <h1>panel</h1>
        <?php else: ?>
        <p>Access Denied</p>
        <?php endif; ?>
    </body>
</html>