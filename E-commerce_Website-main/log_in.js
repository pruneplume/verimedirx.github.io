document.querySelector( 'form[name="log_in"]').addEventListener( 'submit', function(e) {
    
    e.preventDefault();
    
    let user_id_temp = document.querySelector( 'input[name="user_id"]').value;
    let user_pw_temp = document.querySelector( 'input[name="user_pw"]').value;
    
    let userdata_temp = {
        user_id: user_id_temp,
        user_pw: user_pw_temp,
    };

    
    fetch( 'log_in.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify( userdata_temp)
    })
    .then( response => response.json())
    .then( data => {
        console.log('Response:', data);
        // Store the received data
        localStorage.setItem( 'user_id', data.user_id || "null");
        localStorage.setItem( 'user_number', data.user_number || "null");
        localStorage.setItem( 'user_email', data.user_email || "null");
        localStorage.setItem( 'valid', data.valid || false);
        localStorage.setItem( 'timeout', data.timeout || "null");

        userdata.user_id = localStorage.getItem( 'user_id') || "null";
        userdata.user_number = localStorage.getItem( 'user_number') || "null";
        userdata.user_email = localStorage.getItem( 'user_email') || "null";
        userdata.valid = localStorage.getItem( 'valid') || false;
        userdata.timeout = localStorage.getItem( 'timeout') || "null";

        globalThis.location.href = "index.html?user_id=" + userdata.user_id + "&user_number=" + encodeURIComponent(userdata.user_number) + "&user_email=" + userdata.user_email + "&valid=" + userdata.valid + "&timeout=" + userdata.timeout;
    })
    .catch(error => console.error( 'log_in fetch Error:', error));

});
