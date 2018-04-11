function printRecords(response) {
    var array = JSON.parse(response);
    var messageList = document.getElementById('messages-list');
    array.forEach(function (element) {
        var message = document.createElement('div');
        message.setAttribute('class','list-group-item');
        var author = document.createElement('div');
        author.setAttribute('class', 'author');
        author.innerHTML = element['email'];
        var content = document.createElement('div');
        content.setAttribute('class', 'content');
        content.innerHTML = element['text'];
        message.appendChild(author);
        message.appendChild(content);
        messageList.appendChild(message);
    });
}

function getRecords() {
    var xhr = getXMLHttpRequest();
    xhr.open("POST", 'getRecords.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState !== 4) return;
        if (xhr.status === 200) {
            printRecords(xhr.responseText);
        }
    };
    xhr.send();
}

function getXMLHttpRequest() {
    var xmlHttpReq;
    if (window.XMLHttpRequest) {
        xmlHttpReq = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        try {
            xmlHttpReq = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (exp1) {
            try {
                xmlHttpReq = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (exp2) {
                alert("Exception in getXMLHttpRequest()!");
            }
        }
    }
    return xmlHttpReq;
}