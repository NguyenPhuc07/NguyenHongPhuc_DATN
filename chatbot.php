<style>
    #test {
        inset: 0 !important;
        left: 30px !important;
        bottom: 50px !important;
        top: 360px !important;
        height: fit-content;
    }

    #init {
        margin-top: 2rem;
        background: indianred;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        color: aliceblue;
        cursor: pointer;
        position: fixed;
        bottom: 50px;
        left: 30px;
    }

    .desc p {
        color: rgb(133, 153, 168);
        margin: 0;
        font-weight: 600;
    }

    .text {
        font-size: 65px;
        font-weight: 800;
        color: cadetblue;
        margin: 0;
    }

    .parent {
        position: relative;
        height: 100%;
        padding: 0 7rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        left: 50px;
        z-index: 999;
    }

    .bot-img {
        width: 20rem;
        height: 20rem;
    }

    .child {
        box-shadow: 0 0 2px salmon;
        border-radius: 15px;
        height: 30rem;
        width: 16rem;
        margin: auto;
        background: white;
    }

    .header img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        margin: 0 0.5rem;
        border: 1px solid rgb(231, 231, 231);
        padding: 5px;
    }

    .header {
        position: absolute;
        top: 0;
        display: flex;
        align-items: center;
        border-bottom: 1px solid whitesmoke;
        background: white;
        width: 16rem;
        padding: 5px 0;
        border-top-right-radius: 15px;
        border-top-left-radius: 15px;
        z-index: 1;
        box-shadow: 0 0 2px rgb(175, 175, 175);
    }

    .h-child {
        display: flex;
        align-items: center;
    }

    .header span {
        font-size: 13px;
        margin: 0;
        padding: 0;
    }

    .refBtn {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        background: none;
        border: none;
        border-radius: 50%;
        color: indianred;
        font-size: 18px;
        cursor: pointer;
    }

    .name {
        font-weight: 600;
    }

    #chat-box {
        position: relative;
        top: 40px;
        padding: 8px 10px;
        font-size: 12px;
        height: 24.2rem;
        overflow: auto;
        background: rgb(224, 241, 253);
        text-align: center;
    }

    /* these classes will be used in javascript file */
    .msg {
        background: white;
        padding: 5px 15px;
        border-top-right-radius: 15px;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
        width: max-content;
        font-size: 14px;
        color: lightslategrey;
        box-shadow: 0 0 5px rgb(226, 226, 226);
        max-width: 65%;
        text-align: left;
    }

    .test {
        text-align: right;
        margin: 20px 0;
    }

    .rep {
        background: rgb(253, 243, 224);
        color: lightslategray;
        border-top-right-radius: 15px;
        border-bottom-left-radius: 15px;
        border-top-left-radius: 15px;
        font-size: 14px;
        box-shadow: 0 0 5px rgb(211, 211, 211);
    }

    .opt {
        padding: 5px 20px;
        columns: lightsalmon;
        border: 1px solid blueviolet;
        border-radius: 1rem;
        margin: 0.3rem 0.5rem;
        display: inline-block;
        cursor: pointer;
        font-weight: 500;
        background: white;
        text-align: center;
        font-size: 14px;
        color: blueviolet;
    }

    .link {
        text-decoration: none;
        display: block;
        text-align: center;
        color: aliceblue !important;
        background: blueviolet;
    }

    .m-link {
        text-decoration: none;
    }

    .link:active {
        background: white;
        border: 1px solid blueviolet;
        color: blueviolet;
    }
</style>

<button id="init">BẮT ĐẦU TRÒ CHUYỆN</button>
<div id="test" style="position: fixed;top: 4rem;right: 8rem;display: none;left:30px;width:fit-content;bottom:100px">
    <div class="child" id="chatbot">
        <div class="header">
            <div class="h-child">
                <img src="image/chatbot.png" alt="avatar" id="avatar">
                <div>
                    <span class="name">Chatbot</span>
                    <br>
                    <span style="color:lawngreen">online</span>
                </div>
            </div>
            <div>
                <button class="refBtn"><i class="fa fa-refresh" onclick="initChat()"></i></button>
            </div>
        </div>

        <div id="chat-box">

        </div>
    </div>
</div>

<script src="js/chatbot.js"></script>