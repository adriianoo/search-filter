# Searchbar 🔍
_Template is saved in **index.php**_

### Real example could look like this:
```
<form method="post">
    <input type="text" name="Songtitel" placeholder="Songtitel">
    <input type="submit" value="filtern">
</form>
<?php
    $sql="
        SELECT
            *
        from tbl_songs
        INNER JOIN tbl_album ON tbl_songs.FIDAlbum = tbl_album.IDAlbum
        INNER JOIN tbl_interpret ON tbl_album.FIDInterpret = tbl_interpret.IDInterpret
    ";
    // -------------------------------
    // Filter:

    if(count($_POST)>0 && strlen($_POST["Songtitel"])>0) {
        $sql.="
            WHERE(
                tbl_songs.Songtitel LIKE '" . $_POST["Songtitel"] . "%'
            )
        ";
    }

    $sql.= "
        ORDER BY tbl_songs.Songtitel ASC, tbl_album.Albumtitel ASC, tbl_interpret.Interpret ASC
    ";

    // -------------------------------
    // Ausgabe:

    $songs = dbQuery($conn, $sql);
    while($song = $songs->fetch_object()) {
        echo('
            <li> "' . $song->Songtitel . '" aus dem Album "' . $song->Albumtitel . '" (' . $song->Veröffentlichungsjahr . ') von ' . $song->Interpret . ' </li>
        ');
    }
    ?>
```
# **Output:** <br>
![image](https://github.com/user-attachments/assets/00e75fcb-3f24-4671-ac42-9ceea7720987)

**Search filtered:** <br>
![image](https://github.com/user-attachments/assets/8df5427a-e2a1-40ea-93d5-6d14ca96baad)
