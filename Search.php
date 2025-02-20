<?php

function SearchDeck($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $otherPlayer = ($player == 1 ? 2 : 1);
  if (SearchAurasForCard("UPR138", $otherPlayer) != "") {
    WriteLog("Deck search prevented by Channel the Bleak Expanse.");
    return "";
  }
  $deck = &GetDeck($player);
  return SearchInner($deck, $player, "DECK", DeckPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchHand($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $hand = &GetHand($player);
  return SearchInner($hand, $player, "HAND", HandPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchCharacter($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $character = &GetPlayerCharacter($player);
  return SearchInner($character, $player, "CHAR", CharacterPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchPitch($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $searchPitch = &GetPitch($player);
  return SearchInner($searchPitch, $player, "PITCH", PitchPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchDiscard($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false, $getDistinctCardNames = false)
{
  $discard = &GetDiscard($player);
  return SearchInner($discard, $player, "DISCARD", DiscardPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter, $getDistinctCardNames);
}

function SearchBanish($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $banish = &GetBanish($player);
  return SearchInner($banish, $player, "BANISH", BanishPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchCombatChainLink($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  global $combatChain;
  return SearchInner($combatChain, $player, "CC", CombatChainPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchArsenal($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $arsenal = &GetArsenal($player);
  return SearchInner($arsenal, $player, "ARS", ArsenalPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchAura($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $auras = &GetAuras($player);
  return SearchInner($auras, $player, "AURAS", AuraPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchItems($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $items = &GetItems($player);
  return SearchInner($items, $player, "ITEMS", ItemPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchAllies($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $allies = &GetAllies($player);
  return SearchInner($allies, $player, "ALLY", AllyPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchPermanents($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $permanents = &GetPermanents($player);
  return SearchInner($permanents, $player, "PERM", PermanentPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchLayer($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  global $layers;
  return SearchInner($layers, $player, "LAYER", LayerPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchLandmarks($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  global $landmarks;
  return SearchInner($landmarks, $player, "LANDMARK", LandmarkPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchSoul($player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $soul = &GetSoul($player);
  return SearchInner($soul, $player, "SOUL", SoulPieces(), $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}

function SearchCardList($list, $player, $type = "", $subtype = "", $maxCost = -1, $minCost = -1, $class = "", $talent = "", $bloodDebtOnly = false, $phantasmOnly = false, $pitch = -1, $specOnly = false, $maxAttack = -1, $maxDef = -1, $frozenOnly = false, $hasNegCounters = false, $hasEnergyCounters = false, $comboOnly = false, $minAttack = false, $hasCrank = false, $hasSteamCounter = false)
{
  $listArr = explode(",", $list);
  return SearchInner($listArr, $player, "LIST", 1, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
}


function SearchInner(&$array, $player, $zone, $count, $type, $subtype, $maxCost, $minCost, $class, $talents, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter, $getDistinctCardNames = false)
{
  $cardList = "";
  if (!is_array($talents)) $talents = ($talents == "" ? [] : explode(",", $talents));
  for ($i = 0; $i < count($array); $i += $count) {
    if($zone == "CHAR" && $array[$i+1] == 0) continue;
    $cardID = $array[$i];
    if(!isPriorityStep($cardID)) {
      if(($type == "" || CardType($cardID) == $type)
        && ($subtype == "" || DelimStringContains(CardSubType($cardID), $subtype))
        && ($maxCost == -1 || CardCost($cardID) <= $maxCost)
        && ($minCost == -1 || CardCost($cardID) >= $minCost)
        && ($class == "" || ClassContains($cardID, $class, $player))
        && (count($talents) == 0 || TalentContainsAny($cardID, implode(",", $talents), $player))
        && ($pitch == -1 || PitchValue($cardID) == $pitch)
        && ($maxAttack == -1 || AttackValue($cardID) <= $maxAttack)
        && ($minAttack == -1 || AttackValue($cardID) >= $minAttack)
        && ($maxDef == -1 || BlockValue($cardID) <= $maxDef)
      ) {
        if($bloodDebtOnly && (!HasBloodDebt($cardID) || $array[$i+1] == "INT")) continue;
        if($phantasmOnly && !HasPhantasm($cardID)) continue;
        if($specOnly && !IsSpecialization($cardID)) continue;
        if($frozenOnly && !IsFrozenMZ($array, $zone, $i)) continue;
        if($hasNegCounters && $array[$i+4] == 0) continue;
        if($hasEnergyCounters && !HasEnergyCounters($array, $i)) continue;
        if($comboOnly && !HasCombo($cardID)) continue;
        if ($getDistinctCardNames && str_contains($cardList, GamestateSanitize(CardName($cardID)))) continue;
        if($hasCrank && !HasCrank($cardID, $player)) continue;
        if($hasSteamCounter && !HasSteamCounter($array, $i, $player)) continue;
        if($cardList != "") $cardList = $cardList . ",";
        $cardList = $cardList . ($getDistinctCardNames ? GamestateSanitize(CardName($cardID)) : $i);
      }
    }
  }
  return $cardList;
}

function isPriorityStep($cardID)
{
  switch($cardID) {
    case "ENDTURN": case "RESUMETURN": case "PHANTASM": case "MIRAGE": case "FINALIZECHAINLINK": case "DEFENDSTEP": case "ENDSTEP":
      return true;
    default: return false;
  }
}

function SearchHandForCard($player, $card)
{
  $hand = &GetHand($player);
  $indices = "";
  for($i = 0; $i < count($hand); $i += HandPieces()) {
    if($hand[$i] == $card) {
      if($indices != "") $indices .= ",";
      $indices .= $i;
    }
  }
  return $indices;
}

function SearchDeckForCard($player, $card1, $card2 = "", $card3 = "")
{
  $deck = &GetDeck($player);
  $cardList = "";
  for($i = 0; $i < count($deck); $i += DeckPieces()) {
    $id = $deck[$i];
    if(($id == $card1 || $id == $card2 || $id == $card3) && $id != "") {
      if($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList;
}

function SearchDeckByName($player, $name)
{
  $deck = &GetDeck($player);
  $cardList = "";
  for($i = 0; $i < count($deck); $i += DeckPieces()) {
    if(CardName($deck[$i]) == $name) {
      if ($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList;
}

function SearchDiscardByName($player, $name)
{
  $discard = &GetDiscard($player);
  $cardList = "";
  for($i = 0; $i < count($discard); $i += DeckPieces()) {
    if(CardName($discard[$i]) == $name) {
      if($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList;
}

function SearchItemsByName($player, $name)
{
  $items = &GetItems($player);
  $cardList = "";
  for($i = 0; $i < count($items); $i += ItemPieces()) {
    if(CardName($items[$i]) == $name) {
      if($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList;
}

function SearchBanishByName($player, $name)
{
  $banish = &GetBanish($player);
  $cardList = "";
  for($i = 0; $i < count($banish); $i += BanishPieces()) {
    if(CardName($banish[$i]) == $name) {
      if($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList;
}

function SearchDiscardForCard($player, $card1, $card2 = "", $card3 = "")
{
  $discard = &GetDiscard($player);
  $cardList = "";
  for($i = 0; $i < count($discard); $i += DiscardPieces()) {
    $id = $discard[$i];
    if(($id == $card1 || $id == $card2 || $id == $card3) && $id != "") {
      if($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList;
}

function SearchAlliesForCard($player, $card1, $card2 = "", $card3 = "")
{
  $allies = &GetAllies($player);
  $cardList = "";
  for($i = 0; $i < count($allies); $i += AllyPieces()) {
    $id = $allies[$i];
    if(($id == $card1 || $id == $card2 || $id == $card3) && $id != "") {
      if($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList;
}

function SearchAlliesActive($player, $card1, $card2 = "", $card3 = "")
{
  $allies = &GetAllies($player);
  $cardList = "";
  for($i = 0; $i < count($allies); $i += AllyPieces()) {
    $id = $allies[$i];
    if(($id == $card1 || $id == $card2 || $id == $card3) && $id != "") {
      if($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList != "";
}

function SearchPermanentsForCard($player, $card)
{
  $permanents = &GetPermanents($player);
  $indices = "";
  for($i = 0; $i < count($permanents); $i += PermanentPieces()) {
    if($permanents[$i] == $card) {
      if($indices != "") $indices .= ",";
      $indices .= $i;
    }
  }
  return $indices;
}

function SearchEquipNegCounter(&$character)
{
  $equipList = "";
  for($i = 0; $i < count($character); $i += CharacterPieces()) {
    if(CardType($character[$i]) == "E" && $character[$i + 4] < 0 && $character[$i + 1] != 0) {
      if($equipList != "") $equipList = $equipList . ",";
      $equipList = $equipList . $i;
    }
  }
  return $equipList;
}

function SearchCharacterAlive($player, $cardID)
{
  $index = FindCharacterIndex($player, $cardID);
  if($index == -1) return false;
  $char = &GetPlayerCharacter($player);
  return $char[$index+1] > 0;
}

function SearchCharacterActive($player, $cardID, $checkGem=false, $setInactive=false)
{
  $index = FindCharacterIndex($player, $cardID);
  if($index == -1) return false;
  $isActive = IsCharacterAbilityActive($player, $index, $checkGem);
  if($isActive && $setInactive) {
    $char = &GetPlayerCharacter($player);
    $char[$index+1] = 1;
  }
  return $isActive;
}

function SearchCharacterForCard($player, $cardID)
{
  $character = &GetPlayerCharacter($player);
  for($i = 0; $i < count($character); $i += CharacterPieces()) {
    if($character[$i] == $cardID) return true;
  }
  return false;
}

function SearchCharacterAliveSubtype($player, $subtype)
{
  $character = &GetPlayerCharacter($player);
  for($i = 0; $i < count($character); $i += CharacterPieces()) {
    if($character[$i+1] != 0 && CardSubType($character[$i]) == $subtype) return true;
  }
  return false;
}

function FindCharacterIndex($player, $cardID)
{
  $character = &GetPlayerCharacter($player);
  for($i = 0; $i < count($character); $i += CharacterPieces()) {
    if($character[$i] == $cardID) {
      return $i;
    }
  }
  return -1;
}

function CombineSearches($search1, $search2)
{
  if($search2 == "") return $search1;
  else if($search1 == "") return $search2;
  return $search1 . "," . $search2;
}

function SearchRemoveDuplicates($search)
{
  $indices = explode(",", $search);
  for($i = count($indices) - 1; $i >= 0; --$i) {
    for($j = $i - 1; $j >= 0; --$j) {
      if($indices[$j] == $indices[$i]) unset($indices[$i]);
    }
  }
  return implode(",", array_values($indices));
}

function SearchCount($search)
{
  if ($search == "") return 0;
  return count(explode(",", $search));
}

function SearchMultizoneFormat($search, $zone)
{
  if ($search == "") return "";
  $searchArr = explode(",", $search);
  for ($i = 0; $i < count($searchArr); ++$i) {
    $searchArr[$i] = $zone . "-" . $searchArr[$i];
  }
  return implode(",", $searchArr);
}

function SearchCurrentTurnEffects($cardID, $player, $remove = false, $returnUniqueID = false)
{
  global $currentTurnEffects;
  for ($i = 0; $i < count($currentTurnEffects); $i += CurrentTurnEffectPieces()) {
    if ($currentTurnEffects[$i] == $cardID && $currentTurnEffects[$i + 1] == $player) {
      if ($remove) RemoveCurrentTurnEffect($i);
      return $returnUniqueID ? $currentTurnEffects[$i+2] : true;
    }
  }
  return $returnUniqueID ? -1 : false;
}

function SearchCurrentTurnEffectsForCycle($card1, $card2, $card3, $player)
{
  global $currentTurnEffects;
  for ($i = 0; $i < count($currentTurnEffects); $i += CurrentTurnEffectPieces()) {
    if ($currentTurnEffects[$i] == $card1 && $currentTurnEffects[$i + 1] == $player) return true;
    if ($currentTurnEffects[$i] == $card2 && $currentTurnEffects[$i + 1] == $player) return true;
    if ($currentTurnEffects[$i] == $card3 && $currentTurnEffects[$i + 1] == $player) return true;
  }
  return false;
}

function CountCurrentTurnEffects($cardID, $player, $remove = false)
{
  global $currentTurnEffects;
  $count = 0;
  for ($i = 0; $i < count($currentTurnEffects); $i += CurrentTurnEffectPieces()) {
    if ($currentTurnEffects[$i] == $cardID && $currentTurnEffects[$i + 1] == $player) {
      if ($remove) RemoveCurrentTurnEffect($i);
      ++$count;
    }
  }
  return $count;
}

function SearchPitchHighestAttack(&$pitch)
{
  $highest = 0;
  for ($i = 0; $i < count($pitch); ++$i) {
    $av = AttackValue($pitch[$i]);
    if ($av > $highest) $highest = $av;
  }
  return $highest;
}

function SearchPitchForColor($player, $color)
{
  $count = 0;
  $pitch = &GetPitch($player);
  for ($i = 0; $i < count($pitch); $i += PitchPieces()) {
    if (PitchValue($pitch[$i]) == $color) ++$count;
  }
  return $count;
}

//For e.g. Mutated Mass
function SearchPitchForNumCosts($player)
{
  $count = 0;
  $countArr = [];
  $pitch = &GetPitch($player);
  for ($i = 0; $i < count($pitch); $i += PitchPieces()) {
    $cost = CardCost($pitch[$i]);
    while (count($countArr) <= $cost) array_push($countArr, 0);
    if ($countArr[$cost] == 0) ++$count;
    ++$countArr[$cost];
  }
  return $count;
}

function SearchPitchForCard($playerID, $cardID)
{
  $pitch = GetPitch($playerID);
  for($i = 0; $i < count($pitch); ++$i) {
    if($pitch[$i] == $cardID) return $i;
  }
  return -1;
}

function SearchBanishForCard($playerID, $cardID)
{
  $banish = GetBanish($playerID);
  for ($i = 0; $i < count($banish); $i+=BanishPieces()) {
    if ($banish[$i] == $cardID) return $i;
  }
  return -1;
}

function SearchBanishForCardMulti($playerID, $card1, $card2="", $card3="")
{
  $cardList = "";
  $banish = GetBanish($playerID);
  for ($i = 0; $i < count($banish); ++$i) {
    if ($banish[$i] == $card1 || $banish[$i] == $card2 || $banish[$i] == $card3)
    {
      if($cardList != "") $cardList .= ",";
      $cardList .= $i;
    }
  }
  return $cardList;
}

function SearchItemsForCardMulti($playerID, $card1, $card2 = "", $card3 = "")
{
  $cardList = "";
  $items = GetItems($playerID);
  for ($i = 0; $i < count($items); ++$i) {
    if ($items[$i] == $card1 || $items[$i] == $card2 || $items[$i] == $card3) {
      if ($cardList != "") $cardList .= ",";
      $cardList .= $i;
    }
  }
  return $cardList;
}

function SearchHighestAttackDefended()
{
  global $combatChain, $defPlayer;
  $highest = 0;
  for ($i = 0; $i < count($combatChain); $i += CombatChainPieces()) {
    if ($combatChain[$i + 1] == $defPlayer) {
      $av = AttackValue($combatChain[$i]);
      if ($av > $highest) $highest = $av;
    }
  }
  return $highest;
}

function SearchCharacterEffects($player, $index, $effect)
{
  $effects = &GetCharacterEffects($player);
  for ($i = 0; $i < count($effects); $i += CharacterEffectPieces()) {
    if ($effects[$i] == $index && $effects[$i + 1] == $effect) return true;
  }
  return false;
}

function GetArsenalFaceDownIndices($player)
{
  $arsenal = &GetArsenal($player);
  $indices = "";
  for ($i = 0; $i < count($arsenal); $i += ArsenalPieces()) {
    if ($arsenal[$i + 1] == "DOWN") {
      if ($indices != "") $indices .= ",";
      $indices .= $i;
    }
  }
  return $indices;
}

function GetArsenalFaceUpIndices($player)
{
  $arsenal = &GetArsenal($player);
  $indices = "";
  for ($i = 0; $i < count($arsenal); $i += ArsenalPieces()) {
    if ($arsenal[$i + 1] == "UP") {
      if ($indices != "") $indices .= ",";
      $indices .= $i;
    }
  }
  return $indices;
}

function GetEquipmentIndices($player, $maxBlock = -1, $onCombatChain = false)
{
  $character = &GetPlayerCharacter($player);
  $indices = "";
  for ($i = 0; $i < count($character); $i += CharacterPieces()) {
    if ($character[$i + 1] != 0 && CardType($character[$i]) == "E" && ($maxBlock == -1 || (BlockValue($character[$i]) + $character[$i + 4]) <= $maxBlock) && ($onCombatChain == false || $character[$i + 6] > 0)) {
      if ($indices != "") $indices .= ",";
      $indices .= $i;
    }
  }
  return $indices;
}

function SearchAuras($cardID, $player)
{
  $auras = &GetAuras($player);
  $count = 0;
  for ($i = 0; $i < count($auras); $i += AuraPieces()) {
    if ($auras[$i] == $cardID) return true;
  }
  return false;
}

function SearchAurasForCard($cardID, $player, $selfReferential=true)
{
  if(!$selfReferential && SearchCurrentTurnEffects("OUT183", $player)) return "";
  $auras = &GetAuras($player);
  $indices = "";
  for ($i = 0; $i < count($auras); $i += AuraPieces()) {
    if ($auras[$i] == $cardID) {
      if ($indices != "") $indices .= ",";
      $indices .= $i;
    }
  }
  return $indices;
}

function SearchZoneForUniqueID($uniqueID, $player, $zone)
{
  switch($zone)
  {
    case "MYALLY": case "THEIRALLY": return SearchAlliesForUniqueID($uniqueID, $player);
    case "MYAURAS": case "THEIRAURAS": return SearchAurasForUniqueID($uniqueID, $player);
    case "MYARS": case "THEIRARS": return SearchArsenalForUniqueID($uniqueID, $player);
    default: return -1;
  }
}

function SearchForUniqueID($uniqueID, $player)
{
  $index = SearchAurasForUniqueID($uniqueID, $player);
  if ($index == -1) $index = SearchItemsForUniqueID($uniqueID, $player);
  if ($index == -1) $index = SearchAlliesForUniqueID($uniqueID, $player);
  if ($index == -1) $index = SearchArsenalForUniqueID($uniqueID, $player);
  if ($index == -1) $index = SearchLayersForUniqueID($uniqueID);
  return $index;
}

function SearchLayersForUniqueID($uniqueID)
{
  global $layers;
  for($i=0; $i<count($layers); $i+=LayerPieces())
  {
    if($layers[$i+6] == $uniqueID) return $i;
  }
  return -1;
}

function SearchAurasForUniqueID($uniqueID, $player)
{
  $auras = &GetAuras($player);
  for ($i = 0; $i < count($auras); $i += AuraPieces()) {
    if ($auras[$i + 6] == $uniqueID) return $i;
  }
  return -1;
}

function SearchArsenalForUniqueID($uniqueID, $player)
{
  $arsenal = &GetArsenal($player);
  for ($i = 0; $i < count($arsenal); $i += ArsenalPieces()) {
    if ($arsenal[$i + 5] == $uniqueID) return $i;
  }
  return -1;
}

function SearchItemsForUniqueID($uniqueID, $player)
{
  $items = &GetItems($player);
  for ($i = 0; $i < count($items); $i += ItemPieces()) {
    if ($items[$i + 4] == $uniqueID) return $i;
  }
  return -1;
}

function SearchAlliesForUniqueID($uniqueID, $player)
{
  $allies = &GetAllies($player);
  for ($i = 0; $i < count($allies); $i += AllyPieces()) {
    if ($allies[$i + 5] == $uniqueID) return $i;
  }
  return -1;
}

function SearchCurrentTurnEffectsForUniqueID($uniqueID)
{
  global $currentTurnEffects;
  for ($i = 0; $i < count($currentTurnEffects); $i += CurrentTurnEffectPieces()) {
    if ($currentTurnEffects[$i + 2] == $uniqueID) return $i;
  }
  return -1;
}

function SearchUniqueIDForCurrentTurnEffects($index)
{
  global $currentTurnEffects;
  for ($i = 0; $i < count($currentTurnEffects); $i += CurrentTurnEffectPieces()) {
    if ($currentTurnEffects[$i+2] == $index) return $currentTurnEffects[$i];
  }
  return -1;
}

function SearchItemsForCard($cardID, $player)
{
  $items = &GetItems($player);
  $indices = "";
  for($i = 0; $i < count($items); $i += ItemPieces()) {
    if($items[$i] == $cardID) {
      if($indices != "") $indices .= ",";
      $indices .= $i;
    }
  }
  return $indices;
}

function SearchInventoryForCard($player, $cardID)
{
  $inventory = &GetInventory($player);
  $indices = "";
  for($i = 0; $i < count($inventory); $i += InventoryPieces()) {
    if($inventory[$i] == $cardID) {
      if($indices != "") $indices .= ",";
      $indices .= $i;
    }
  }
  return $indices;
}

function SearchLandmark($cardID)
{
  global $landmarks;
  for($i = 0; $i < count($landmarks); $i += LandmarkPieces()) {
    if($landmarks[$i] == $cardID) return true;
  }
  return false;
}

function CountAura($cardID, $player)
{
  $auras = &GetAuras($player);
  $count = 0;
  for($i = 0; $i < count($auras); $i += AuraPieces()) {
    if($auras[$i] == $cardID) ++$count;
  }
  return $count;
}

function GetItemIndex($cardID, $player)
{
  $items = &GetItems($player);
  for($i = 0; $i < count($items); $i += ItemPieces()) {
    if($items[$i] == $cardID) return $i;
  }
  return -1;
}

function GetCombatChainIndex($cardID, $player)
{
  global $combatChain;
  for($i=0; $i<count($combatChain); $i+=CombatChainPieces())
  {
    if($combatChain[$i] == $cardID && $combatChain[$i+1] == $player) return $i;
  }
  return -1;
}

function GetAuraIndex($cardID, $player)
{
  $auras = &GetAuras($player);
  for($i = 0; $i < count($auras); $i += AuraPieces()) {
    if($auras[$i] == $cardID) return $i;
  }
  return -1;
}

function GetAllyIndex($cardID, $player)
{
  $Allies = &GetAllies($player);
  for($i = 0; $i < count($Allies); $i += AllyPieces()) {
    if($Allies[$i] == $cardID) return $i;
  }
  return -1;
}

function CountItem($cardID, $player)
{
  $items = &GetItems($player);
  $count = 0;
  for ($i = 0; $i < count($items); $i += ItemPieces()) {
    if ($items[$i] == $cardID) ++$count;
  }
  return $count;
}

function SearchArsenalReadyCard($player, $cardID)
{
  $arsenal = GetArsenal($player);
  for ($i = 0; $i < count($arsenal); $i += ArsenalPieces()) {
    if ($arsenal[$i] != $cardID) continue;
    if ($arsenal[$i + 1] != "UP") continue;
    if ($arsenal[$i + 2] == 0) continue;
    return $i;
  }
  return -1;
}

function SearchArcaneReplacement($player, $zone)
{
  $cardList = "";
  switch ($zone) {
    case "MYCHAR":
      $array = &GetPlayerCharacter($player);
      $count = CharacterPieces();
      break;
    case "MYITEMS":
      $array = &GetItems($player);
      $count = ItemPieces();
      break;
    case "MYAURAS":
      $array = &GetAuras($player);
      $count = AuraPieces();
      break;
  }
  for ($i = 0; $i < count($array); $i += $count) {
    if ($zone == "MYCHAR" && !IsCharacterAbilityActive($player, $i)) continue;
    $cardID = $array[$i];
    if ((CardType($cardID) == "A" || CardType($cardID) == "T") && $array[$i+7] == 0) continue;
    if (SpellVoidAmount($cardID, $player) > 0 && IsCharacterActive($player, $i)) {
      if ($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    } elseif (SpellVoidAmount($cardID, $player) > 0 && $zone != "MYCHAR") {
      if ($cardList != "") $cardList = $cardList . ",";
      $cardList = $cardList . $i;
    }
  }
  return $cardList;
}

function SearchChainLinks($minPower = -1, $maxPower = -1, $cardType = "")
{
  global $chainLinks;
  $links = "";
  for ($i = 0; $i < count($chainLinks); ++$i) {
    $power = AttackValue($chainLinks[$i][0]);
    $type = CardType($chainLinks[$i][0]);
    if ($chainLinks[$i][2] == "1" && ($minPower == -1 || $power >= $minPower) && ($maxPower == -1 || $power <= $maxPower) && ($cardType == "" || $type == $cardType)) {
      if ($links != "") $links .= ",";
      $links .= $i;
    }
  }
  return $links;
}

function GetRelativeMZCardLink($player, $MZ)
{
  $params = explode("-", $MZ);
  if(count($params) < 2 || $params[0] == "" || $params[1] == "") return "";
  $zoneDS = &GetRelativeMZZone($player, $params[0]);
  $index = $params[1];
  if($index == "") return "";
  return CardLink($zoneDS[$index], $zoneDS[$index]);
}

function GetMZCardLink($player, $MZ)
{
  if($MZ == "") return "";
  $params = explode("-", $MZ);
  $zoneDS = &GetMZZone($player, $params[0]);
  $index = $params[1];
  if($index == "") return "";
  return CardLink($zoneDS[$index], $zoneDS[$index]);
}

//$searches is the following format:
//Each search is delimited by &, which means a set UNION
//Each search is the format <zone>:<condition 1>;<condition 2>,...
//Each condition is format <search parameter name>=<parameter value>
//Example: AddDecisionQueue("MULTIZONEINDICES", $currentPlayer, "MYHAND:maxAttack=3;type=AA");
function SearchMultizone($player, $searches)
{
  $otherPlayer = ($player == 1 ? 2 : 1);
  $unionSearches = explode("&", $searches);
  $rv = "";
  for($i = 0; $i < count($unionSearches); ++$i) {
    $type = "";
    $subtype = "";
    $maxCost = -1;
    $minCost = -1;
    $class = "";
    $talent = "";
    $bloodDebtOnly = false;
    $phantasmOnly = false;
    $pitch = -1;
    $specOnly = false;
    $maxAttack = -1;
    $minAttack = -1;
    $maxDef = -1;
    $frozenOnly = false;
    $hasNegCounters = false;
    $hasEnergyCounters = false;
    $comboOnly = false;
    $hasCrank = false;
    $hasSteamCounter = false;
    $searchArr = explode(":", $unionSearches[$i]);
    $zone = $searchArr[0];
    $isCardID = false;
    $isSameName = false;
    if(count($searchArr) > 1) //Means there are conditions
    {
      $conditions = explode(";", $searchArr[1]);
      for($j = 0; $j < count($conditions); ++$j) {
        $condition = explode("=", $conditions[$j]);
        switch($condition[0]) {
          case "type":
            $type = $condition[1];
            break;
          case "subtype":
            $subtype = $condition[1];
            break;
          case "maxCost":
            $maxCost = $condition[1];
            break;
          case "minCost":
            $minCost = $condition[1];
            break;
          case "class":
            $class = $condition[1];
            break;
          case "talent":
            $talent = $condition[1];
            break;
          case "bloodDebtOnly":
            $bloodDebtOnly = $condition[1];
            break;
          case "phantasmOnly":
            $phantasmOnly = $condition[1];
            break;
          case "pitch":
            $pitch = $condition[1];
            break;
          case "specOnly":
            $specOnly = $condition[1];
            break;
          case "maxAttack":
            $maxAttack = $condition[1];
            break;
          case "minAttack":
            $minAttack = $condition[1];
            break;
          case "maxDef":
            $maxDef = $condition[1];
            break;
          case "frozenOnly":
            $frozenOnly = $condition[1];
            break;
          case "hasNegCounters":
            $hasNegCounters = $condition[1];
            break;
          case "hasEnergyCounters":
            $hasEnergyCounters = $condition[1];
            break;
          case "comboOnly":
            $comboOnly = $condition[1];
            break;
          case "hasCrank":
            $hasCrank = $condition[1];
            break;
          case "hasSteamCounter":
            $hasSteamCounter = $condition[1];
            break;
          case "cardID":
            $cards = explode(",", $condition[1]);
            switch($zone)
            {
              case "MYDECK":
                if(count($cards) == 1) $searchResult = SearchDeckForCard($player, $cards[0]);
                else if(count($cards) == 2) $searchResult = SearchDeckForCard($player, $cards[0], $cards[1]);
                else if(count($cards) == 3) $searchResult = SearchDeckForCard($player, $cards[0], $cards[1], $cards[2]);
                else WriteLog("Discard multizone search only supports 3 cards -- report bug.");
                break;
              case "MYDISCARD":
                if(count($cards) == 1) $searchResult = SearchDiscardForCard($player, $cards[0]);
                else if(count($cards) == 2) $searchResult = SearchDiscardForCard($player, $cards[0], $cards[1]);
                else if(count($cards) == 3) $searchResult = SearchDiscardForCard($player, $cards[0], $cards[1], $cards[2]);
                else WriteLog("Discard multizone search only supports 3 cards -- report bug.");
                break;
              case "MYBANISH":
                if(count($cards) == 1) $searchResult = SearchBanishForCardMulti($player, $cards[0]);
                else if(count($cards) == 2) $searchResult = SearchBanishForCardMulti($player, $cards[0], $cards[1]);
                else if(count($cards) == 3) $searchResult = SearchBanishForCardMulti($player, $cards[0], $cards[1], $cards[2]);
                else WriteLog("Banish multizone search only supports 3 cards -- report bug.");
                break;
              case "MYITEMS":
                if (count($cards) == 1) $searchResult = SearchItemsForCardMulti($player, $cards[0]);
                else if (count($cards) == 2) $searchResult = SearchItemsForCardMulti($player, $cards[0], $cards[1]);
                else if (count($cards) == 3) $searchResult = SearchItemsForCardMulti($player, $cards[0], $cards[1], $cards[2]);
                else WriteLog("Discard multizone search only supports 3 cards -- report bug.");
                break;
              default: break;
            }
            $searchResult = SearchMultiZoneFormat($searchResult, $zone);
            $rv = CombineSearches($rv, $searchResult);
            $isCardID = true;
            break;
          case "sameName":
            $name = CardName($condition[1]);
            switch($zone)
            {
              case "MYDECK": $searchResult = SearchDeckByName($player, $name); break;
              case "MYDISCARD": $searchResult = SearchDiscardByName($player, $name); break;
              case "MYITEMS": $searchResult = SearchItemsByName($player, $name); break;
              case "MYBANISH": $searchResult = SearchBanishByName($player, $name); break;
              case "THEIRDISCARD": $searchResult = SearchDiscardByName($otherPlayer, $name); break;
              default: break;
            }
            $rv = SearchMultiZoneFormat($searchResult, $zone);
            //$rv = CombineSearches($rv, $searchResult);
            $isSameName = true;
            break;
          default:
            break;
        }
      }
    }
    $searchPlayer = (substr($zone, 0, 2) == "MY" ? $player : ($player == 1 ? 2 : 1));
    $searchResult = "";
    if(!$isCardID && !$isSameName)
    {
      switch ($zone) {
        case "MYDECK": case "THEIRDECK":
          $searchResult = SearchDeck($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYHAND": case "THEIRHAND":
          $searchResult = SearchHand($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYDISCARD": case "THEIRDISCARD":
          $searchResult = SearchDiscard($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYARS": case "THEIRARS":
          $searchResult = SearchArsenal($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYAURAS": case "THEIRAURAS":
          $searchResult = SearchAura($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYCHAR": case "THEIRCHAR":
          $searchResult = SearchCharacter($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
          break;
        case "MYITEMS": case "THEIRITEMS":
          $searchResult = SearchItems($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank, $hasSteamCounter);
          break;
        case "MYALLY": case "THEIRALLY":
          $searchResult = SearchAllies($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYPERM": case "THEIRPERM":
          $searchResult = SearchPermanents($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYBANISH": case "THEIRBANISH":
          $searchResult = SearchBanish($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYPITCH": case "THEIRPITCH":
          $searchResult = SearchPitch($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "MYSOUL": case "THEIRSOUL":
          $searchResult = SearchSoul($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "COMBATCHAINLINK":
          $searchResult = SearchCombatChainLink($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "LAYER":
          $searchResult = SearchLayer($searchPlayer, $type, $subtype, $maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        case "LANDMARK":
          $searchResult = SearchLandmarks($searchPlayer, $type, $subtype,$maxCost, $minCost, $class, $talent, $bloodDebtOnly, $phantasmOnly, $pitch, $specOnly, $maxAttack, $maxDef, $frozenOnly, $hasNegCounters, $hasEnergyCounters, $comboOnly, $minAttack, $hasCrank);
          break;
        default:
          break;
      }
    }
    $searchResult = SearchMultiZoneFormat($searchResult, $zone);
    $rv = CombineSearches($rv, $searchResult);
  }
  return $rv;
}

function MZToIndices($mzSearch)
{
  $output = "";
  $mzSearchArr = explode(",", $mzSearch);
  for($i=0; $i<count($mzSearchArr); ++$i)
  {
    $mzArr = explode("-", $mzSearchArr[$i]);
    if($output != "") $output .= ",";
    $output .= $mzArr[1];
  }
  return $output;
}

function IntimidateCount($player)
{
  $otherPlayer = ($player == 1 ? 2 : 1);
  $banish = &GetBanish($otherPlayer);
  $count = 0;
  for($i = 0; $i < count($banish); $i += BanishPieces()) {
    if($banish[$i + 1] == "INT") ++$count;
  }
  return $count;
}

function FrozenCount($player)
{
  $numFrozen = 0;
  $char = &GetPlayerCharacter($player);
  for ($i = 0; $i < count($char); $i += CharacterPieces())
    if ($char[$i + 8] == "1" && $char[$i + 1] != "0")
      ++$numFrozen;
  $allies = &GetAllies($player);
  for ($i = 0; $i < count($allies); $i += AllyPieces())
    if ($allies[$i + 3] == "1")
      ++$numFrozen;
  $arsenal = &GetArsenal($player);
  for ($i = 0; $i < count($arsenal); $i += ArsenalPieces())
    if ($arsenal[$i + 4] == "1")
      ++$numFrozen;
  return $numFrozen;
}

function SearchSpellvoidIndices($player)
{
  $search = SearchArcaneReplacement($player, "MYCHAR");
  $charIndices = SearchMultizoneFormat($search, "MYCHAR");
  $search = SearchArcaneReplacement($player, "MYITEMS");
  $itemsIndices = SearchMultizoneFormat($search, "MYITEMS");
  $indices = CombineSearches($charIndices, $itemsIndices);
  $search = SearchArcaneReplacement($player, "MYAURAS");
  $auraIndices = SearchMultizoneFormat($search, "MYAURAS");
  $indices = CombineSearches($indices, $auraIndices);

  return $indices;
}

function SearchGetFirst($search)
{
  if($search == "") return "";
  $arr = explode(",", $search);
  return $arr[0];
}

function SearchGetFirstIndex($search)
{
  $firstMZ = SearchGetFirst($search);
  if($search == "") return "";
  $arr = explode("-", $firstMZ);
  return $arr[1];
}

function SearchLayersForCardID($cardID)
{
  global $layers;
  for($i=0; $i<count($layers); $i+=LayerPieces())
  {
    if($layers[$i+2] == $cardID) return $i;
  }
  return -1;
}
