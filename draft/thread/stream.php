<?php

namespace Ziel\Thread;

class Stream {

    public function stream_init()
    {
        print '<pre>';
        var_dump($SESSION);
        print '</pre>';
        if (!$this->stream_globals()) throw_exception('session_init()');
        return true;
    }
    
    public function stream_globals()
    {
        
        
        
        
// Hello World! SSL HTTP Server.
// Tested on PHP 5.1.2-1+b1 (cli) (built: Mar 20 2006 04:17:24)

// Certificate data:
$dn = array(
    "countryName" => "CA",
    "stateOrProvinceName" => "Ontario",
    "localityName" => "Wheatley",
    "organizationName" => "Invest Lead Management",
    "organizationalUnitName" => "Legal Studies Team",
    "commonName" => "Robert-Dan Dumitrascu",
    "emailAddress" => "robertddan2401@gmail.com"
);

// Generate certificate
$privkey = openssl_pkey_new();
$cert    = openssl_csr_new($dn, $privkey);
$cert    = openssl_csr_sign($cert, null, $privkey, 365);

// Generate PEM file
# Optionally change the passphrase from 'comet' to whatever you want, or leave it empty for no passphrase
$pem_passphrase = 'comet';
$pem = array();
openssl_x509_export($cert, $pem[0]);
openssl_pkey_export($privkey, $pem[1], $pem_passphrase);
$pem = implode($pem);

// Save PEM file
$pemfile = DRAFT .'/static/server.pem';
file_put_contents($pemfile, $pem);

$context = stream_context_create();

// local_cert must be in PEM format
stream_context_set_option($context, 'ssl', 'local_cert', $pemfile);
// Pass Phrase (password) of private key
stream_context_set_option($context, 'ssl', 'passphrase', $pem_passphrase);
stream_context_set_option($context, 'ssl', 'allow_self_signed', true);
stream_context_set_option($context, 'ssl', 'verify_peer', false);

// Create the server socket
$server = stream_socket_server('ssl://0.0.0.0:9001', $errno, $errstr, STREAM_SERVER_BIND|STREAM_SERVER_LISTEN, $context);

while(true)
{
    $buffer = '';
    print "waiting...";
    $client = stream_socket_accept($server);
    print "accepted " . stream_socket_get_name( $client, true) . "\n";
    if( $client )
    {
        // Read until double CRLF
        while( !preg_match('/\r?\n\r?\n/', $buffer) )
            $buffer .= fread($client, 2046); 
        // Respond to client
        fwrite($client,  "200 OK HTTP/1.1\r\n"
                         . "Connection: close\r\n"
                         . "Content-Type: text/html\r\n"
                         . "\r\n"
                         . "Hello World! " . microtime(true)
                         . "<pre>{$buffer}</pre>");
        fclose($client);
    } else {
        print "error.\n";
    }
}



    }
}

?>