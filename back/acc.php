<fieldset style="width:75%;margin:auto;">
    <legend>帳號管理</legend>
    <table>
        <tr>
            <td>帳號</td>
            <td>密碼</td>
            <td>刪除</td>
        </tr>
        <?php
        $rows=$User->all();
        foreach($rows as $row):
        ?>
        <tr>
            <td><?=$row['acc'];?></td>
            <td><?=str_repeat("*",strlen($row['pw']));?></td>
            <td>
                <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
            </td>
        </tr>
        <?php endforeach;?>
    </table>














    <h2>新增會員</h2>
    <fieldset style="width:60%;margin:auto;">
        <legend>會員註冊</legend>
        <div style="color:red">
            *請設定您要註冊的帳號及密碼(最常12個字元)
        </div>
        <table>
            <tr>
                <td>Step:1登入帳號</td>
                <td><input type="text" name="acc" id="acc"></td>
            </tr>
            <tr>
                <td>Step:2登入密碼</td>
                <td><input type="password" name="pw" id="pw"></td>
            </tr>
            <tr>
                <td>Step:3再次確認密碼</td>
                <td><input type="password" name="pw2" id="pw2"></td>
            </tr>
            <tr>
                <td>Step:4信箱(忘記密碼時使用)</td>
                <td><input type="text" name="emaol" id="email"></td>
            </tr>
            <tr>

                <td>
                    <input type="button" value="註冊" onclick='reg()'>
                    <input type="button" value="清除" onclick='restform()'>
                </td>

            </tr>
        </table>
    </fieldset>

    <script>
    function del() {
        let dels = $("input[name='del'[];checked");
        let ids = new Array();
        dels.each(idx)
    }

    function reg() {
        let user = {
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            pw2: $("#pw2").val(),
            email: $("#email").val(),


        }
        if (user.acc == "" || user.pw == "" || user.pw2 == "" || user.email == "") {
            alert("不可空白");
        } else if (user.pw != user.pw2) {
            alert("密碼錯誤");
        } else {
            $.get("./api/chk_acc.php", {
                acc: user.acc
            }, (res) => {
                // console.log("chk acc => ", res)
                if (parseInt(res) > 0) {
                    alert("帳號重複")
                } else {
                    $.post("./api/reg.php", user, (res) => {
                        // console.log("reg => ", res)
                        // if (parseInt(res) == 1) {
                        //     alert("註冊完成，歡迎加入")
                        // }
                    })
                }
            })
        }
    }

    function restForm() {
        let user = {
            acc: $("#acc").val(''),
            pw: $("#pw").val(''),
            pw2: $("#pw2").val(''),
            email: $("#email").val(''),
        }

        function resetChk() {
            $("input[type='checkbox']").prop("checked", false)
        }
    }
    </script>
</fieldset>