<?php
/**
 * Created by PhpStorm.
 * User: kiko
 * Date: 08.02.16
 * Time: 22:15
 */
?>
<div class="row">
    <div class="form-group col-sm-6">
        <label for="name" class="h4">Iм`я</label>
        <input type="text" class="form-control" id="name" placeholder="Введiть iм`я" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="email" class="h4">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Введiть email" required>
    </div>
</div>
<div class="form-group">
    <label for="message" class="h4 ">Message</label>
    <textarea id="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea>
</div>
<button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right ">Надiслати</button>
<div id="msgSubmit" class="h3 text-center hidden">Message Submitted!</div>
<div class="clearfix"></div>