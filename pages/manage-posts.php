<?php

  $database = connectToDB();

  /*
    use ORDER BY to sort by column
    use ASC to sort by ascending order (lowest value first)
    use DESC tp sort by descending order (highest value first)
  */
  $user_id = $_SESSION["user"]["id"];
  /*
    use WHERE to filter by user_id
  */
  if ( isEditor() ) {
    // no filter for admin or editor
    $sql = "SELECT * FROM posts ORDER BY id DESC";
    $query = $database->prepare( $sql );
    $query->execute();
  } else {
    // filter by user_id for normal user
    $sql = "SELECT * FROM posts WHERE user_id = :user_id ORDER BY id DESC";
    $query = $database->prepare( $sql );
    $query->execute([
      "user_id" => $user_id
    ]);
  }

  $posts = $query->fetchAll();
?>
<?php require "parts/header.php"; ?>
<div class="container mx-auto my-5" style="max-width: 700px;">
      <div class="d-flex justify-content-between align-items-center mb-2">
        <h1 class="h1">Manage Posts</h1>
        <div class="text-end">
          <a href="/manage-posts-add" class="btn btn-primary btn-sm"
            >Add New Post</a
          >
        </div>
      </div>
      <div class="card mb-2 p-4">
        <?php require "parts/message_success.php"; ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col" style="width: 40%;">Title</th>
              <th scope="col">Status</th>
              <th scope="col" class="text-end">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach( $posts as $post ) : ?>
            <tr>
              <th scope="row"><?= $post["id"]; ?></th>
              <td><?= $post["title"]; ?></td>
              <?php if ( $post["status"] === 'pending' ) : ?>
                <td><span class="badge bg-warning">Pending Review</span></td>
              <?php else: ?>
                <td><span class="badge bg-success">Publish</span></td>
              <?php endif; ?>
              <td class="text-end">
                <div class="buttons">
                  <a
                    href="/post?id=<?= $post["id"]; ?>"
                    target="_blank"
                    class="btn btn-primary btn-sm me-2 <?php echo ( $post["status"] === 'pending' ? "disabled" : "" ); ?>"
                    ><i class="bi bi-eye"></i
                  ></a>
                  <a
                    href="/manage-posts-edit?id=<?= $post["id"]; ?>"
                    class="btn btn-secondary btn-sm me-2"
                    ><i class="bi bi-pencil"></i
                  ></a>
                  <!-- Button to trigger delete confirmation modal -->
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#postDeleteModal-<?php echo $post['id']; ?>">
                     <i class="bi bi-trash"></i>
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="postDeleteModal-<?php echo $post['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure you want to delete this post?</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start">
                          <p>You're currently trying to delete this post: <?php echo $post['title']; ?></p>
                          <p>This action cannot be reversed.</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <form
                            method="POST"
                            action="/post/delete"
                            class="d-inline"
                            >
                            <input type="hidden" 
                                name="post_id"
                                value="<?= $post["id"]; ?>" />
                              <button class="btn btn-danger"><i class="bi bi-trash me-2"></i>DELETE</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end of modal -->
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="text-center">
        <a href="/dashboard" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back to Dashboard</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>