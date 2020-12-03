
.messageSection .header {
margin-top: 24px;
margin-bottom: 32px;
display: flex;
flex-direction: column;
}

.messageSection .header .messageForm .profilePicture,
.messageSection .message .profilePicture,
.messageForm .profilePicture {
margin-right: 16px;
width: 48px;
height: 48px;
border-radius: 50%;
}

.messageSection .header .messageCount {
margin-bottom: 24px;
}

.messageSection .header .messageForm,
.itemContainer .messageForm {
display: flex;
}

.messageSection .header .messageForm textarea,
.itemContainer .messageForm textarea {
flex: 1;
border: none;
background-color: transparent;
font-size: 14px;
color: #111;
resize: none;
}

.itemContainer .messageForm textarea {
height: 30px;
}

.messageSection .header .messageForm .postMessage,
.itemContainer .messageForm .postMessage,
.itemContainer .messageForm .cancelMessage {
height: 36px;
background-color: #2692e6;
color: #fff;
font-weight: 500;
border: none;
padding: 0 15px;
border-radius: 2px;
}

.itemContainer .messageForm .cancelMessage {
background-color: transparent;
color: rgba(17,17,17,0.6);
}

.itemContainer .messageForm .cancelMessage:hover {
color:#000;
}

.messageSection .itemContainer {
margin-bottom: 16px;
}

.messageSection .message {
display: flex;
}

.messageSection .messageHeader {
margin-bottom: 2px;
}

.messageSection .message .username {
margin-right: 8px;
color: #111;
font-size: 13px;
font-weight:500;
}

.messageSection .message .body {
font-size: 14px;
font-weight: 400;
line-height: 20px;
}
