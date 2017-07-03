<?=$this->layout('layout', ['title' => 'Liste des terrains']); ?>


<?=$this->start('main_content');?>

<input type='text' name='searchWhere'>
<input type='date' name='date'>
<label for='has_match'>Match</label>
<input type='checkbox' name='has_match'>
<label for='distanceSlider'>
<input id="distance" data-slider-id='distanceSlider' type="text" data-slider-min="0" data-slider-max="50" data-slider-step="1" data-slider-value="50"/>


<?=$this->stop('main_content');?>