

<label for="appendix" class="required">用途区分</label>
    <select id="selectbox"name="appendix" >
    <option value="0" <?= $appendix == 0 ? 'selected' : '' ?>>選択</option>
    <optgroup label="特定防火対象物">
        <option value="1">１項イ　</option>
        <option value="2">１項ロ　</option>
        <option value="3">2項イ　</option>
        <option value="4">2項ロ　</option>
        <option value="5">2項ハ　</option>
        <option value="6">2項ニ　</option>
        <option value="7">3項イ　</option>
        <option value="8">3項ロ　</option>
        <option value="9"> 4項 　</option>
        <option value="10">5項イ　</option>
        <option value="12">6項イ(1)(ⅰ)</option>
        <option value="13">6項イ(1)(ⅱ)</option>
        <option value="14">6項イ(2)(ⅰ)　</option>
        <option value="15">6項イ(2)(ⅱ)　</option>
        <option value="16">6項イ(3)　</option>
        <option value="17">6項イ(4)　</option>
        <option value="18">6項ロ(1)　</option>
        <option value="19">6項ロ(2)　</option>
        <option value="20">6項ロ(3)　</option>
        <option value="21">6項ロ(4)　</option>
        <option value="22">6項ロ(5)　</option>
        <option value="23">6項ハ(1)　</option>
        <option value="24">6項ハ(2)　</option>
        <option value="25">6項ハ(3)　</option>
        <option value="26">6項ハ(4)　</option>
        <option value="27">6項ハ(5)　</option>
        <option value="28">6項ニ　</option>
        <option value="31">9項イ　</option>
        <option value="41">16項イ　</option>
        <option value="43">16項の2　</option>
    </optgroup>
    <optgroup label="非特定防火対象物">
        <option value="11">5項ロ　</option>
        <option value="29">7項　　</option>
        <option value="30">8項　　</option>
        <option value="32">9項ロ　</option>
        <option value="33">10項 　</option>
        <option value="34">11項　　</option>
        <option value="35">12項イ　</option>
        <option value="36">12項ロ　</option>
        <option value="37">13項イ　</option>
        <option value="38">13項ロ　</option>
        <option value="39">14項　</option>
        <option value="40">15項　</option>
        <option value="42">16項ロ　</option>
        <option value="44">16項の3　</option>
        <option value="45">17項　</option>
        <option value="46">18項　</option>
        <option value="47">19項　</option>
        <option value="48">20項　</option>
    </optgroup>
    </select>
    <?php if(!empty($error_appendix)) : ?>
            <ul class="error-message-appendix">
                    <li><?= $error_appendix[0] ?></li>
            </ul>
    <?php endif; ?>
