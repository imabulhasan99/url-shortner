
<h2 align="center">
 <b>Welcome to my URL Shortener API!</b>
</h2>

<p>
    With this API, you can easily and safely shorten your URLs. By registering and obtaining an API key, you can generate short URLs for your long ones. Moreover, you can also access a list of all the URLs you have registered.
</p>

<span><b>This is an example where you can communicate with this API through your php application.</b></span>
<h6> All endpoints </h6>
<ol>
    <li>Login: $loginUrl = 'http://maindomain.com/api/v1/login'</li>
    <li>Register: $loginUrl = 'http://maindomain.com/api/v1/register'</li>
    <li>Create Shorturl: $loginUrl = 'http://maindomain.com/api/v1/create'</li>
    <li>Show all previous shorturl: $loginUrl = 'http://maindomain.com/api/v1/list'</li>
</ol>
Note: Login, Register, and create a short URL endpoint that will accept only POST requests and show all shorturl will receive GET request.
At the very beginning, if you don't register yet you should register through the register endpoint. After successful registration, you will get a token and store it, or if you are already ready to complete registration but didn't store your token then you log in with your credentials. after successful login, you will get a new token, store it and it should be sent through the header to the server.

<h4><b>Example Login request:</b></h4> 

<pre> 
$loginData = [
    'email' => 'your email',
    'password' => 'your_password',
];

$loginResponse = makeCurlRequest($loginUrl, 'POST', $headers, $loginData);

    
function makeCurlRequest($url, $method, $headers = [], $data = [])
{
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_HTTPHEADER => $headers,
    ]);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }

    curl_close($ch);

    return json_decode($response, true);
}

</pre>
Here I create a custom function called makeCurlRequest() where 4 arguments are required. The first parameter will be the endpoint as described earlier, the second parameter will be the HTTP method, the third method will be a header like your authentication token, and the final parameter will be which data should be processed. Such that for login it will be login credentials, for register, it will be register credentials, for short URL creating it will be full URL.
