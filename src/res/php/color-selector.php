<div class="colorEditor" id="colorSelector">
    <div class="titleBar">
        <button onclick="showColorSelector(false);"><img src="res/img/back.png" /></button>
        <p>Sélectionnez une couleur</p>
    </div>
    <ul class="tabs">
        <li id="tabListColors" onclick="$('#colorSelector .colorSelector').slideDown(); $('#colorSelector .customiseColor').slideUp(); $('#tabInputColor').removeClass('current'); $('#tabListColors').addClass('current');" class="current">Couleurs prédéfinies</li>
        <li id="tabInputColor" onclick="$('#colorSelector .colorSelector').slideUp(); $('#colorSelector .customiseColor').slideDown(); $('#tabListColors').removeClass('current'); $('#tabInputColor').addClass('current');">Couleur personnalisée</li>
    </ul>
    <ul class="colorSelector">
        <li onclick="setSelectedColor('#AD7FA8');" style="background: #AD7FA8;"></li>
        <li onclick="setSelectedColor('#FF6496');" style="background: #FF6496;"></li>
        <li onclick="setSelectedColor('#EF2929');" style="background: #EF2929;"></li>
        <li onclick="setSelectedColor('#E9B96E');" style="background: #E9B96E;"></li>
        <li onclick="setSelectedColor('#FCAF3E');" style="background: #FCAF3E;"></li>
        <li onclick="setSelectedColor('#FCE94F');" style="background: #FCE94F;"></li>
        <li onclick="setSelectedColor('#8AE234');" style="background: #8AE234;"></li>
        <li onclick="setSelectedColor('#37FF9B');" style="background: #37FF9B;"></li>
        <li onclick="setSelectedColor('#9BC3E6');" style="background: #9BC3E6;"></li>
        <li onclick="setSelectedColor('#729FCF');" style="background: #729FCF;"></li>
        <li onclick="setSelectedColor('#888A85');" style="background: #888A85;"></li>
        <br />
        <li onclick="setSelectedColor('#75507B');" style="background: #75507B;"></li>
        <li onclick="setSelectedColor('#FF0064');" style="background: #FF0064;"></li>
        <li onclick="setSelectedColor('#CC0000');" style="background: #CC0000;"></li>
        <li onclick="setSelectedColor('#C17D11');" style="background: #C17D11;"></li>
        <li onclick="setSelectedColor('#F57900');" style="background: #F57900;"></li>
        <li onclick="setSelectedColor('#EDD400');" style="background: #EDD400;"></li>
        <li onclick="setSelectedColor('#73D216');" style="background: #73D216;"></li>
        <li onclick="setSelectedColor('#00C864');" style="background: #00C864;"></li>
        <li onclick="setSelectedColor('#00AAF0');" style="background: #00AAF0;"></li>
        <li onclick="setSelectedColor('#3465A4');" style="background: #3465A4;"></li>
        <li onclick="setSelectedColor('#555753');" style="background: #555753;"></li>
        <br />
        <li onclick="setSelectedColor('#5C3566');" style="background: #5C3566;"></li>
        <li onclick="setSelectedColor('#C80064');" style="background: #C80064;"></li>
        <li onclick="setSelectedColor('#A40000');" style="background: #A40000;"></li>
        <li onclick="setSelectedColor('#8F5902');" style="background: #8F5902;"></li>
        <li onclick="setSelectedColor('#CE5C00');" style="background: #CE5C00;"></li>
        <li onclick="setSelectedColor('#C4A000');" style="background: #C4A000;"></li>
        <li onclick="setSelectedColor('#4E9A06');" style="background: #4E9A06;"></li>
        <li onclick="setSelectedColor('#329664');" style="background: #329664;"></li>
        <li onclick="setSelectedColor('#006EBE');" style="background: #006EBE;"></li>
        <li onclick="setSelectedColor('#204A87');" style="background: #204A87;"></li>
        <li onclick="setSelectedColor('#2E3436');" style="background: #2E3436;"></li>
    </ul>
    <div class="customiseColor">
        <div class="viewer"></div>
        <div class="editor">
            <p class="red"><span>Rouge</span><input type="number" min="0" max="255" onchange="updateInputColor();" onkeyup="updateInputColor();"/></p>
            <p class="green"><span>Vert</span><input type="number" min="0" max="255" onchange="updateInputColor();" onkeyup="updateInputColor();"/></p>
            <p class="blue"><span>Bleu</span><input type="number" min="0" max="255" onchange="updateInputColor();" onkeyup="updateInputColor();"/></p>
        </div>
    </div>
</div>


<script src="res/js/color-selector.js"></script>
<script src="res/js/convert.js"></script>