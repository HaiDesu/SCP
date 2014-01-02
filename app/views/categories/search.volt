<?php use Phalcon\Tag; ?>

<?php echo $this->getContent(); ?>

<table width="100%">
    <tr>
        <td align="left">
            <?php echo $this->tag->linkTo(array("genres/index", "Go Back")); ?>
        </td>
        <td align="right">
            <?php echo $this->tag->linkTo(array("genres/new", "Create ")); ?>
        </td>
    <tr>
</table>

<table class="browse" align="center">
    <thead>
        <tr>
            <th>Id</th>
            <th>Label</th>
            <th>Description</th>
         </tr>
    </thead>
    <tbody>
    <?php foreach ($page->items as $genre) { ?>
        <tr>
            <td><?php echo $genre->id ?></td>
            <td><?php echo $genre->label ?></td>
            <td><?php echo $genre->description ?></td>
            <td><?php echo $this->tag->linkTo(array("genres/edit/" . $genre->id, "Edit")); ?></td>
            <td><?php echo $this->tag->linkTo(array("genres/delete/" . $genre->id, "Delete")); ?></td>
        </tr>
    <?php } ?>
    </tbody>
    <tbody>
        <tr>
            <td colspan="2" align="right">
                <table align="center">
                    <tr>
                        <td><?php echo $this->tag->linkTo("genres/search", "First") ?></td>
                        <td><?php echo $this->tag->linkTo("genres/search?page=" . $page->before, "Previous") ?></td>
                        <td><?php echo $this->tag->linkTo("genres/search?page=" . $page->next, "Next") ?></td>
                        <td><?php echo $this->tag->linkTo("genres/search?page=" . $page->last, "Last") ?></td>
                        <td><?php echo $page->current, "/", $page->total_pages ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    <tbody>
</table>
