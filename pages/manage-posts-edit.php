<?php

  // connect to the database
  $database = connectToDB();

  // get the id from the URL /manage-users.edit?id=1
  $id = $_GET['id'];

  // load the existing data from the user
  // sql command
  $sql = "SELECT * FROM posts WHERE id = :id";
  // prepare
  $query = $database->prepare($sql);
  // execute
  $query->execute([
    'id' => $id
  ]);
  // fetch
  $post = $query->fetch(); // get only one row of data

  /*
    title - $user['title]
    content - $user['content']
    status - $user['status']
  */

   require 'parts/header.php';
?>

<div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Edit Post</h1>
      </div>
      <div class="card mb-2 p-4">
         <!--
        Requirements:
        - [DONE] setup the form with action route and method
        - [DONE] Add names into the fields
        - [DONE] setup a hidden input for the $user['id']
        - [DONE] display the error message
        -->
        <form method="POST" action="/post/edit">
         <?php require "parts/message_error.php"?>
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
              type="text"
              class="form-control"
              id="title"
              name='title'
              value="<?= $post['title']; ?>"
            />
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name='content' rows="10"><?= $post['content']; ?></textarea>
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status">

              <?php if ( $post['status'] == 'publish' ) : ?>
                <option value="publish" selected>Publish</option>
              <?php else: ?>
                <option value="publish">Publish</option>
              <?php endif; ?>

              <?php if ( $post['status'] == 'pending' ) : ?>
                <option value="pending" selected>Pending Review</option>
              <?php else: ?>
                <option value="pending">Pending Review</option>
              <?php endif; ?>

            </select>
          </div>
          <div class="text-end">
            <input type="hidden" name="id" value="<?= $post["id"]; ?>" />
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </form>
      </div>
      <div class="text-center">
        <a href="/manage-posts" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Posts</a
        >
      </div>
    </div>

    <?php
       require 'parts/footer.php';
    ?>