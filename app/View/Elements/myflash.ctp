<blockquote id="<?php echo $key; ?>Message" class="<?php echo !empty($params['class']) ? $params['class'] : 'message'; ?>"><?php echo $message; ?></blockquote>

<?php if(isset($params['resend'])){?>
<button class="waves-effect waves-light btn-small orange resend-email" data-email="<?= $params['email']?>">Resend E-mail</button>
<?php } ?>