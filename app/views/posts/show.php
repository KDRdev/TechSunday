<?php require APPROOT . '/views/inc/header.phtml'; ?>
<div class="container">
  <div class="row mb-3">
    <div class="col-12">
      <h1><?php echo $data['post']->title; ?></h1>
      <p><?php echo $data['post']->body; ?></p>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-6 text-left">
      <a class="btn btn-primary text-white" href="<?php echo URLROOT; ?>posts/edit/<?php echo $data['post']->id ?>">Edit</a>
    </div>
    <div class="col-6 text-right">
      <form action="<?php echo URLROOT; ?>posts/delete/<?php echo $data['post']->id; ?>" method="post">
        <button type="submit" class="btn btn-danger">Delete</button>
      </form>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.phtml'; ?>