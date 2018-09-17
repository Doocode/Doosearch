<?php $lang->setSection('search_engines'); ?>
<div class="closeListSearchEngines" onclick="showMotors();"></div>
<div class="popupSearchEngines">
    <div class="top">
        <div class="titleBar">
            <div class="left">
                <img src="res/img/back.png" title="<?= $lang->getKey("go_back"); ?>" onclick="showMotors();" />
                <h4><?= $lang->getKey("search_engines"); ?></h4>
            </div>
            <div class="right">
                <img id="list" src="res/img/list2.png" onclick="showAsList(true);" title="<?= $lang->getKey("show_as_list"); ?>" />
                <img id="icons" src="res/img/icons2.png" onclick="showAsList(false);" title="<?= $lang->getKey("show_as_icons"); ?>" />
                <img id="recherche" class="checked" src="res/img/find.png" onclick="toggleSearchBar();" title="<?= $lang->getKey("research_search_engines"); ?>" />
            </div>
        </div>

        <div class="searchBar">
            <img id="icon" src="res/img/search.png" />
            <input id="findEngine" type="text" placeholder="<?= $lang->getKey("research_search_engines"); ?>" />
            <button class="cleaner" onclick="clearSearchBar();" title="<?= $lang->getKey("clear_search_bar"); ?>"><img src="res/img/clear.png" /></button>
        </div>
    </div>
        
    <div class="center"><ul class="searchEngines"></ul></div>
</div>

<div class="central menu" onclick="hideMenuEngine();">
    <div class="aligner"></div>
    <div class="menuEngine">
        <div class="view">
            <img src="res/img/choose.png" />
            <h5>Lorem ipsum</h5>
        </div>
        <ul class="actions">
            <li id="actSetEngine" onclick="needToPinMotor=false; needToAddSelectedMotor=false; setSearchEngine(currentContextEngine);">
                <img src="res/img/use.png" />
                <p><?= $lang->getKey("use_this_search_engine"); ?></p>
            </li>
            <li id="actAddEngine" onclick="needToPinMotor=false; needToAddSelectedMotor=true; setSearchEngine(currentContextEngine);">
                <img src="res/img/add2.png" />
                <p><?= $lang->getKey("add_this_search_engine"); ?></p>
            </li>
            <li id="actRemoveEngine" onclick="removeSelectedEngine(currentContextEngine);">
                <img src="res/img/remove.png" />
                <p><?= $lang->getKey("deselect_this_search_engine"); ?></p>
            </li>
            <li id="actPinEngine" onclick="needToPinMotor = true; needToAddSelectedMotor=false; setSearchEngine(currentContextEngine);">
                <img src="res/img/pin.png" />
                <p><?= $lang->getKey("pin_this_search_engine"); ?></p>
            </li>
            <li id="actUnpinEngine" onclick="removePinnedEngine(currentContextEngine);">
                <img src="res/img/remove.png" />
                <p><?= $lang->getKey("unpin_this_search_engine"); ?></p>
            </li>
        </ul>
    </div>
</div>