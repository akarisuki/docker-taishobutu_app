
<div class="input-group">
    <label for="appendix" class="required">用途区分</label>
        <select id="selectbox"name="appendix" >
        <option value="0" <?= $appendix == 0 ? 'selected' : '' ?>>選択</option>
        <optgroup label="特定防火対象物">
            <option value="1"<?= $appendix == 1 ? 'selected' : '' ?>>１項イ　</option>
            <option value="2"<?= $appendix == 2 ? 'selected' : '' ?>>１項ロ　</option>
            <option value="3"<?= $appendix == 3 ? 'selected' : '' ?>>2項イ　</option>
            <option value="4"<?= $appendix == 4 ? 'selected' : '' ?>>2項ロ　</option>
            <option value="5"<?= $appendix == 5 ? 'selected' : '' ?>>2項ハ　</option>
            <option value="6"<?= $appendix == 6 ? 'selected' : '' ?>>2項ニ　</option>
            <option value="7"<?= $appendix == 7 ? 'selected' : '' ?>>3項イ　</option>
            <option value="8"<?= $appendix == 8 ? 'selected' : '' ?>>3項ロ　</option>
            <option value="9"<?= $appendix == 9 ? 'selected' : '' ?>> 4項 　</option>
            <option value="10"<?= $appendix == 10 ? 'selected' : '' ?>>5項イ　</option>
            <option value="12"<?= $appendix == 12 ? 'selected' : '' ?>>6項イ(1)(ⅰ)</option>
            <option value="13"<?= $appendix == 13 ? 'selected' : '' ?>>6項イ(1)(ⅱ)</option>
            <option value="14"<?= $appendix == 14 ? 'selected' : '' ?>>6項イ(2)(ⅰ)　</option>
            <option value="15"<?= $appendix == 15 ? 'selected' : '' ?>>6項イ(2)(ⅱ)　</option>
            <option value="16"<?= $appendix == 16 ? 'selected' : '' ?>>6項イ(3)　</option>
            <option value="17"<?= $appendix == 17 ? 'selected' : '' ?>>6項イ(4)　</option>
            <option value="18"<?= $appendix == 18 ? 'selected' : '' ?>>6項ロ(1)　</option>
            <option value="19"<?= $appendix == 19 ? 'selected' : '' ?>>6項ロ(2)　</option>
            <option value="20"<?= $appendix == 20 ? 'selected' : '' ?>>6項ロ(3)　</option>
            <option value="21"<?= $appendix == 21 ? 'selected' : '' ?>>6項ロ(4)　</option>
            <option value="22"<?= $appendix == 22 ? 'selected' : '' ?>>6項ロ(5)　</option>
            <option value="23"<?= $appendix == 23 ? 'selected' : '' ?>>6項ハ(1)　</option>
            <option value="24"<?= $appendix == 24 ? 'selected' : '' ?>>6項ハ(2)　</option>
            <option value="25"<?= $appendix == 25 ? 'selected' : '' ?>>6項ハ(3)　</option>
            <option value="26"<?= $appendix == 26 ? 'selected' : '' ?>>6項ハ(4)　</option>
            <option value="27"<?= $appendix == 27 ? 'selected' : '' ?>>6項ハ(5)　</option>
            <option value="28"<?= $appendix == 28 ? 'selected' : '' ?>>6項ニ　</option>
            <option value="31"<?= $appendix == 31 ? 'selected' : '' ?>>9項イ　</option>
            <option value="41"<?= $appendix == 41 ? 'selected' : '' ?>>16項イ　</option>
            <option value="43"<?= $appendix == 43 ? 'selected' : '' ?>>16項の2　</option>
        </optgroup>
        <optgroup label="非特定防火対象物">
            <option value="11"<?= $appendix == 11 ? 'selected' : '' ?>>5項ロ　</option>
            <option value="29"<?= $appendix == 29 ? 'selected' : '' ?>>7項　　</option>
            <option value="30"<?= $appendix == 30 ? 'selected' : '' ?>>8項　　</option>
            <option value="32"<?= $appendix == 32 ? 'selected' : '' ?>>9項ロ　</option>
            <option value="33"<?= $appendix == 33 ? 'selected' : '' ?>>10項 　</option>
            <option value="34"<?= $appendix == 34 ? 'selected' : '' ?>>11項　　</option>
            <option value="35"<?= $appendix == 35 ? 'selected' : '' ?>>12項イ　</option>
            <option value="36"<?= $appendix == 36 ? 'selected' : '' ?>>12項ロ　</option>
            <option value="37"<?= $appendix == 37 ? 'selected' : '' ?>>13項イ　</option>
            <option value="38"<?= $appendix == 38 ? 'selected' : '' ?>>13項ロ　</option>
            <option value="39"<?= $appendix == 39 ? 'selected' : '' ?>>14項　</option>
            <option value="40"<?= $appendix == 40 ? 'selected' : '' ?>>15項　</option>
            <option value="42"<?= $appendix == 42 ? 'selected' : '' ?>>16項ロ　</option>
            <option value="44"<?= $appendix == 44 ? 'selected' : '' ?>>16項の3　</option>
            <option value="45"<?= $appendix == 45 ? 'selected' : '' ?>>17項　</option>
            <option value="46"<?= $appendix == 46 ? 'selected' : '' ?>>18項　</option>
            <option value="47"<?= $appendix == 47 ? 'selected' : '' ?>>19項　</option>
            <option value="48"<?= $appendix == 48 ? 'selected' : '' ?>>20項　</option>
        </optgroup>
        </select>
        <a href="http://www.chikuta119.jp/info/ihan_kohyo/pdf/beppyo01.pdf" target="_blank">用途区分ガイド</a><br/>
        <?php if(!empty($error_appendix)) : ?>
                <ul class="error-message-appendix">
                        <li><?= $error_appendix[0] ?></li>
                </ul>
        <?php endif; ?>
</div>
