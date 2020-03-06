<?php require APPROOT . '/views/inc/header.phtml'; ?>
<div class="container">
  <div class="row">
    <div class="col-12">
    <h1>Edit post</h1>
      <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="post">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" name="title" class="form-control form-control-lg<?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
          <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
        </div>
        <div class="form-group">
          <label for="body">Your post</label>
          <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body']; ?></textarea>
          <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
        </div>
        <div class="row">
          <div class="col">
            <input type="submit" name="" value="Update" class="btn btn-success btn-block">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<?php require APPROOT . '/views/inc/footer.phtml'; ?>