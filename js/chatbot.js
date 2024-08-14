// Cập nhật data với các tùy chọn có dấu
var data = {
  chatinit: {
    title: [
      "Chào bạn <span class='emoji'> &#128075;</span>",
      "Tôi là Chatbot của Hồng Phúc Sports",
      "Tôi có thể giúp gì cho bạn?",
    ],
    options: ["Sản phẩm thể thao", "Bộ sưu tập", "Tin tức thể thao"],
  },
  "san pham the thao": {
    title: ["Vui lòng chọn loại sản phẩm"],
    options: ["Áo CLUB", "Áo ĐTQG", "Giày bóng đá"],
    url: {},
  },
  "tin tuc the thao": {
    title: ["3 Tin tức thể thao nổi bật hôm nay"],
    options: [
      "Tin Tức Thể Thao Bóng Đá",
      "Giảm Giá Đặc Biệt Mùa Hè",
      "Tin Tức Mới Nhất về Thể Thao",
    ],
    url: {
      more: "http://localhost/sports/tin-t%E1%BB%A9c.php",
      link: [
        "http://localhost/sports/tin-t%E1%BB%A9c.php",
        "http://localhost/sports/tin-t%E1%BB%A9c.php",
        "http://localhost/sports/tin-t%E1%BB%A9c.php",
      ],
    },
  },
  "ao club": {
    title: ["Vui lòng chọn loại Áo CLB"],
    options: [
      "Arsenal",
      "Manchester United",
      "Tottenham Hotspur",
      "Manchester City",
    ],
    url: {
      more: "http://localhost/sports/cartegory.php?loaisanpham_id=1",
      link: [
        "http://localhost/sports/cartegory.php?loaisanpham_id=1",
        "http://localhost/sports/cartegory.php?loaisanpham_id=3",
        "http://localhost/sports/cartegory.php?loaisanpham_id=8",
        "http://localhost/sports/cartegory.php?loaisanpham_id=13",
      ],
    },
  },
  "ao dtqg": {
    title: ["Vui lòng chọn loại Áo ĐTQG"],
    options: ["CÁC LOẠI ÁO ĐTQG", "Bồ Đào Nha"],
    url: {
      more: "http://localhost/sports/cartegory.php?loaisanpham_id=6",
      link: [
        "http://localhost/sports/cartegory.php?loaisanpham_id=6",
        "http://localhost/sports/cartegory.php?loaisanpham_id=7",
      ],
    },
  },
  "giay bong da": {
    title: ["Vui lòng chọn loại Giày bóng đá"],
    options: ["Giày Toni Kroos", "Giày CR7"],
    url: {
      more: "http://localhost/sports/cartegory.php?loaisanpham_id=9",
      link: [
        "http://localhost/sports/cartegory.php?loaisanpham_id=9",
        "http://localhost/sports/cartegory.php?loaisanpham_id=10",
      ],
    },
  },
  "bo suu tap": {
    title: [
      "Cảm ơn bạn đã quan tâm",
      "Chào mừng bạn đến xem Bộ sưu tập <span class='emoji'> &#128176;</span>",
      "Vui lòng chọn một  Bộ sưu tập trong các tùy chọn bên dưới để tiếp tục",
    ],
    options: ["Bộ sưu tập"],
    url: {
      more: "http://localhost/sports/b%E1%BB%99-s%C6%B0u-t%E1%BA%ADp.php",
      link: [
        "http://localhost/sports/b%E1%BB%99-s%C6%B0u-t%E1%BA%ADp.php",
      ],
    },
  },
};

// Hàm chuyển đổi ký tự có dấu thành không dấu
function removeVietnameseTones(str) {
  var map = {
    à: "a",
    á: "a",
    ả: "a",
    ã: "a",
    ạ: "a",
    â: "a",
    ấ: "a",
    ầ: "a",
    ẩ: "a",
    ẫ: "a",
    ậ: "a",
    ă: "a",
    ắ: "a",
    ằ: "a",
    ẳ: "a",
    ẵ: "a",
    ặ: "a",
    è: "e",
    é: "e",
    ẻ: "e",
    ẽ: "e",
    ẹ: "e",
    ê: "e",
    ế: "e",
    ề: "e",
    ể: "e",
    ễ: "e",
    ệ: "e",
    ì: "i",
    í: "i",
    ỉ: "i",
    ĩ: "i",
    ị: "i",
    ò: "o",
    ó: "o",
    ỏ: "o",
    õ: "o",
    ọ: "o",
    ô: "o",
    ố: "o",
    ồ: "o",
    ổ: "o",
    ỗ: "o",
    ộ: "o",
    ơ: "o",
    ớ: "o",
    ờ: "o",
    ở: "o",
    ỡ: "o",
    ợ: "o",
    ù: "u",
    ú: "u",
    ủ: "u",
    ũ: "u",
    ụ: "u",
    ư: "u",
    ứ: "u",
    ừ: "u",
    ử: "u",
    ữ: "u",
    ự: "u",
    ỳ: "y",
    ý: "y",
    ỷ: "y",
    ỹ: "y",
    ỵ: "y",
    đ: "d",
    À: "A",
    Á: "A",
    Ả: "A",
    Ã: "A",
    Ạ: "A",
    Â: "A",
    Ấ: "A",
    Ầ: "A",
    Ẩ: "A",
    Ẫ: "A",
    Ậ: "A",
    Ă: "A",
    Ắ: "A",
    Ằ: "A",
    Ẳ: "A",
    Ẵ: "A",
    Ặ: "A",
    È: "E",
    É: "E",
    Ẻ: "E",
    Ẽ: "E",
    Ẹ: "E",
    Ê: "E",
    Ế: "E",
    Ề: "E",
    Ể: "E",
    Ễ: "E",
    Ệ: "E",
    Ì: "I",
    Í: "I",
    Ỉ: "I",
    Ĩ: "I",
    Ị: "I",
    Ò: "O",
    Ó: "O",
    Ỏ: "O",
    Õ: "O",
    Ọ: "O",
    Ô: "O",
    Ố: "O",
    Ồ: "O",
    Ổ: "O",
    Ỗ: "O",
    Ộ: "O",
    Ơ: "O",
    Ớ: "O",
    Ờ: "O",
    Ở: "O",
    Ỡ: "O",
    Ợ: "O",
    Ù: "U",
    Ú: "U",
    Ủ: "U",
    Ũ: "U",
    Ụ: "U",
    Ư: "U",
    Ứ: "U",
    Ừ: "U",
    Ử: "U",
    Ữ: "U",
    Ự: "U",
    Ỳ: "Y",
    Ý: "Y",
    Ỷ: "Y",
    Ỹ: "Y",
    Ỵ: "Y",
    Đ: "D",
  };
  return str
    .split("")
    .map(function (char) {
      return map[char] || char;
    })
    .join("");
}

document.getElementById("init").addEventListener("click", showChatBot);
var cbot = document.getElementById("chat-box");

var len1 = data.chatinit.title.length;

function showChatBot() {
  console.log(this.innerText);
  if (this.innerText == "BẮT ĐẦU TRÒ CHUYỆN") {
    document.getElementById("test").style.display = "block";
    document.getElementById("init").innerText = "ĐÓNG TRÒ CHUYỆN";
    initChat();
  } else {
    location.reload();
  }
}

function initChat() {
  j = 0;
  cbot.innerHTML = "";
  for (var i = 0; i < len1; i++) {
    setTimeout(handleChat, i * 500);
  }
  setTimeout(function () {
    showOptions(data.chatinit.options);
  }, (len1 + 1) * 500);
}

var j = 0;
function handleChat() {
  console.log(j);
  var elm = document.createElement("p");
  elm.innerHTML = data.chatinit.title[j];
  elm.setAttribute("class", "msg");
  cbot.appendChild(elm);
  j++;
  handleScroll();
}

function showOptions(options) {
  for (var i = 0; i < options.length; i++) {
    var opt = document.createElement("span");
    var inp = "<div>" + options[i] + "</div>";
    opt.innerHTML = inp;
    opt.setAttribute("class", "opt");
    opt.addEventListener("click", handleOpt);
    cbot.appendChild(opt);
    handleScroll();
  }
}

function handleOpt() {
  console.log(this);
  var str = this.innerHTML.trim();
  var findText = removeVietnameseTones(
    str
      .toLowerCase()
      .replace(/<[^>]+>/g, "")
      .trim()
  );

  document.querySelectorAll(".opt").forEach((el) => {
    el.remove();
  });
  var elm = document.createElement("p");
  elm.setAttribute("class", "test");
  var sp = '<span class="rep">' + this.innerHTML.trim() + "</span>";
  elm.innerHTML = sp;
  cbot.appendChild(elm);

  console.log(findText);
  var tempObj = data[findText];
  if (tempObj) {
    handleResults(tempObj.title, tempObj.options, tempObj.url);
  } else {
    handleDelay("Xin lỗi, tôi không hiểu lựa chọn của bạn.");
  }
}

function handleDelay(title) {
  var elm = document.createElement("p");
  elm.innerHTML = title;
  elm.setAttribute("class", "msg");
  cbot.appendChild(elm);
}

function handleResults(title, options, url) {
  for (let i = 0; i < title.length; i++) {
    setTimeout(function () {
      handleDelay(title[i]);
    }, i * 500);
  }

  const isObjectEmpty = (url) => {
    return JSON.stringify(url) === "{}";
  };

  if (isObjectEmpty(url)) {
    console.log("Có thêm tùy chọn");
    setTimeout(function () {
      showOptions(options);
    }, title.length * 500);
  } else {
    console.log("Kết quả cuối cùng");
    setTimeout(function () {
      handleOptions(options, url);
    }, title.length * 500);
  }
}

function handleOptions(options, url) {
  for (var i = 0; i < options.length; i++) {
    var opt = document.createElement("span");
    var inp =
      '<a class="m-link" href="' + url.link[i] + '">' + options[i] + "</a>";
    opt.innerHTML = inp;
    opt.setAttribute("class", "opt");
    cbot.appendChild(opt);
  }
  var opt = document.createElement("span");
  var inp = '<a class="m-link" href="' + url.more + '">' + "Xem thêm</a>";

  opt.innerHTML = inp;
  opt.setAttribute("class", "opt link");
  cbot.appendChild(opt);
  handleScroll();
}

function handleScroll() {
  var elem = document.getElementById("chat-box");
  elem.scrollTop = elem.scrollHeight;
}
