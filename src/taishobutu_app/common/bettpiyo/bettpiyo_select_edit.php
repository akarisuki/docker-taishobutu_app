

<label for="appendix" class="required">用途区分</label>
    <select id="selectbox"name="appendix" >
    <option value="0" <?= $edit_data['appendix'] === 0 ? 'selected' : '' ?>>選択</option>
    <optgroup label="特定防火対象物">
        <option value="1"<?= $edit_data['appendix'] === 1 ? 'selected' : '' ?>>１項イ　</option>
        <option value="2"<?= $edit_data['appendix'] === 2 ? 'selected' : '' ?>>１項ロ　</option>
        <option value="3"<?= $edit_data['appendix'] === 3 ? 'selected' : '' ?>>2項イ　</option>
        <option value="4"<?= $edit_data['appendix'] === 4 ? 'selected' : '' ?>>2項ロ　</option>
        <option value="5"<?= $edit_data['appendix'] === 5 ? 'selected' : '' ?>>2項ハ　</option>
        <option value="6"<?= $edit_data['appendix'] === 6 ? 'selected' : '' ?>>2項ニ　</option>
        <option value="7"<?= $edit_data['appendix'] === 7 ? 'selected' : '' ?>>3項イ　</option>
        <option value="8"<?= $edit_data['appendix'] === 8 ? 'selected' : '' ?>>3項ロ　</option>
        <option value="9"<?= $edit_data['appendix'] === 9 ? 'selected' : '' ?>> 4項 　</option>
        <option value="10"<?= $edit_data['appendix'] === 10 ? 'selected' : '' ?>>5項イ　</option>
        <option value="12"<?= $edit_data['appendix'] === 12 ? 'selected' : '' ?>>6項イ(1)(ⅰ)</option>
        <option value="13"<?= $edit_data['appendix'] === 13 ? 'selected' : '' ?>>6項イ(1)(ⅱ)</option>
        <option value="14"<?= $edit_data['appendix'] === 14 ? 'selected' : '' ?>>6項イ(2)(ⅰ)　</option>
        <option value="15"<?= $edit_data['appendix'] === 15 ? 'selected' : '' ?>>6項イ(2)(ⅱ)　</option>
        <option value="16"<?= $edit_data['appendix'] === 16 ? 'selected' : '' ?>>6項イ(3)　</option>
        <option value="17"<?= $edit_data['appendix'] === 17 ? 'selected' : '' ?>>6項イ(4)　</option>
        <option value="18"<?= $edit_data['appendix'] === 18 ? 'selected' : '' ?>>6項ロ(1)　</option>
        <option value="19"<?= $edit_data['appendix'] === 19 ? 'selected' : '' ?>>6項ロ(2)　</option>
        <option value="20"<?= $edit_data['appendix'] === 20 ? 'selected' : '' ?>>6項ロ(3)　</option>
        <option value="21"<?= $edit_data['appendix'] === 21 ? 'selected' : '' ?>>6項ロ(4)　</option>
        <option value="22"<?= $edit_data['appendix'] === 22 ? 'selected' : '' ?>>6項ロ(5)　</option>
        <option value="23"<?= $edit_data['appendix'] === 23 ? 'selected' : '' ?>>6項ハ(1)　</option>
        <option value="24"<?= $edit_data['appendix'] === 24 ? 'selected' : '' ?>>6項ハ(2)　</option>
        <option value="25"<?= $edit_data['appendix'] === 25 ? 'selected' : '' ?>>6項ハ(3)　</option>
        <option value="26"<?= $edit_data['appendix'] === 26 ? 'selected' : '' ?>>6項ハ(4)　</option>
        <option value="27"<?= $edit_data['appendix'] === 27 ? 'selected' : '' ?>>6項ハ(5)　</option>
        <option value="28"<?= $edit_data['appendix'] === 28 ? 'selected' : '' ?>>6項ニ　</option>
        <option value="31"<?= $edit_data['appendix'] === 31 ? 'selected' : '' ?>>9項イ　</option>
        <option value="41"<?= $edit_data['appendix'] === 41 ? 'selected' : '' ?>>16項イ　</option>
        <option value="43"<?= $edit_data['appendix'] === 43 ? 'selected' : '' ?>>16項の2　</option>
    </optgroup>
    <optgroup label="非特定防火対象物">
        <option value="11"<?= $edit_data['appendix'] === 11 ? 'selected' : '' ?>>5項ロ　</option>
        <option value="29"<?= $edit_data['appendix'] === 29 ? 'selected' : '' ?>>7項　　</option>
        <option value="30"<?= $edit_data['appendix'] === 30 ? 'selected' : '' ?>>8項　　</option>
        <option value="32"<?= $edit_data['appendix'] === 32 ? 'selected' : '' ?>>9項ロ　</option>
        <option value="33"<?= $edit_data['appendix'] === 33 ? 'selected' : '' ?>>10項 　</option>
        <option value="34"<?= $edit_data['appendix'] === 34 ? 'selected' : '' ?>>11項　　</option>
        <option value="35"<?= $edit_data['appendix'] === 35 ? 'selected' : '' ?>>12項イ　</option>
        <option value="36"<?= $edit_data['appendix'] === 36 ? 'selected' : '' ?>>12項ロ　</option>
        <option value="37"<?= $edit_data['appendix'] === 37 ? 'selected' : '' ?>>13項イ　</option>
        <option value="38"<?= $edit_data['appendix'] === 38 ? 'selected' : '' ?>>13項ロ　</option>
        <option value="39"<?= $edit_data['appendix'] === 39 ? 'selected' : '' ?>>14項　</option>
        <option value="40"<?= $edit_data['appendix'] === 40 ? 'selected' : '' ?>>15項　</option>
        <option value="42"<?= $edit_data['appendix'] === 42 ? 'selected' : '' ?>>16項ロ　</option>
        <option value="44"<?= $edit_data['appendix'] === 44 ? 'selected' : '' ?>>16項の3　</option>
        <option value="45"<?= $edit_data['appendix'] === 45 ? 'selected' : '' ?>>17項　</option>
        <option value="46"<?= $edit_data['appendix'] === 46 ? 'selected' : '' ?>>18項　</option>
        <option value="47"<?= $edit_data['appendix'] === 47 ? 'selected' : '' ?>>19項　</option>
        <option value="48"<?= $edit_data['appendix'] === 48 ? 'selected' : '' ?>>20項　</option>
    </optgroup>
    </select>
    <?php if(!empty($error_appendix)) : ?>
            <ul class="error-message-appendix">
                    <li><?= $error_appendix[0] ?></li>
            </ul>
    <?php endif; ?>
