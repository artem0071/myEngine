<h3>Зарегестрироваться</h3>
<form autocomplete="off" method="post" action="../core/modules/reg.php">
    <input type="hidden" name="lang" value="<?= $this->Rout->Lang?>">
    <label for="name">Имя
        <input type="text" name="name" id="name"></label>
    <br/>
    <label for="pass">Пароль
        <input type="password" name="pass" id="pass"></label>
    <br/>
    <button type="submit" name="post">Зарегестрироваться</button>
</form>