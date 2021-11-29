<div class="container-md mt-3 pb-2 shadow">
    <h3 class="text-center my-3">News</h3>
    <div class="row">
        <div class="col col-12 col-md-6 my-3 d-flex">
            <input name="key" class="form-control me-2" type="search" id="search" placeholder="Search news by title or classification" aria-label="Search">
            <button class="btn btn-outline-dark" type="button" onclick="filter()"><i class="fas fa-search"></i></button>
        </div>
        <div class="col col-12 col-md-6 my-3">
            <div class="row">
                <div class="col col-2 d-none d-md-block"></div>
                <div class="col col-4 col-sm-3">
                    <label for="sort" class="col-form-label">Sort by date</label>
                </div>
                <div class="col col-6">
                    <select id="dateSort" class="form-select" aria-label="Default select example" onchange="filter()">
                        <option value="1" selected>Latest</option>
                        <option value="-1">Oldest</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4 mt-5" id="newsContainer">
        <?php
        foreach ($models as $model) {
        ?>
            <div class="col">
                <div class="card mb-3 shadow" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4 d-flex align-items-center bg-secondary">
                            <?php if (isset($model->image_url) && strlen($model->image_url > 0)) { ?>
                                <img src="<?php echo $model->image_url ?>" class="img-fluid rounded-start" alt="News">
                            <?php } ?>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body" style="min-height: 200px;">
                                <h6 class="card-title"><?php echo $model->title ?></h6>
                                <p class="card-text"><?php if (strlen($model->content) > 80) echo substr($model->content, 0, 80) . "...";
                                                        else echo $model->content; ?></p>
                            </div>
                            <div class="card-footer">
                                <p class="card-text"><small class="text-muted">Post at <?php echo $model->date ?></small></p>
                                <a href="/news/view?id=<?php echo $model->id ?>" class="btn btn-warning stretched-link">Read</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<script>
    const models = <?php echo json_encode($models) ?>;
    let keyword = "";
    let dateOrder = 1;

    function filter() {
        keyword = $("#search").val();
        dateOrder = $("#dateSort").val();
        elems = [];
        for (const model of models.sort((a, b) => ((Date.parse(b.date) - Date.parse(a.date)) * dateOrder))) {
            if ((keyword !== null && keyword.length !== 0) && !model.title.toLowerCase().includes(keyword.toLowerCase())) {
                continue;
            }
            elems.push(`
                <div class="col">
                    <div class="card mb-3 shadow" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4 d-flex align-items-center bg-secondary">
                                <img src="https://cdn.tgdd.vn/Files/2021/11/24/1400272/galaxynote20ght-2_1280x720-800-resize.jpg" class="img-fluid rounded-start" alt="News">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="min-height: 200px;">
                                    <h6 class="card-title">${model.title}</h6>
                                    <p class="card-text">${model.title && model.title.length > 80 ? model.title.substring(0, 80) + "..." : model.title}
                                </div>
                                <div class="card-footer">
                                    <p class="card-text"><small class="text-muted">Post at ${model.date}</small></p>
                                    <a href="/news/view?id=${model.id}" class="btn btn-warning stretched-link">Read</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        }
        $("#newsContainer").empty().append(elems);
    }

    function convertDateTime(dt) {
        const dateTime = dt.split(" ");
        var date = dateTime[0].split("-");
        var yyyy = date[0];
        var mm = date[1] - 1;
        var dd = date[2];

        var time = dateTime[1].split(":");
        var h = time[0];
        var m = time[1];
        var s = parseInt(time[2]);

        return new Date(yyyy, mm, dd, h, m, s);
    }
</script>