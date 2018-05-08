<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
        <link rel="stylesheet" href="pub/css/bootstrap.css">
        <link rel="stylesheet" href="pub/css/main.css">
    </head>
    <body>
        <div class="album py-5 bg-light">
            <div class="container">
                <h1 class="h1 text-center">Form Example</h1>
                <form action="/submit" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Text</label>
                        <input type="text" class="form-control" name="exampleFormControlInput1">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Example select</label>
                        <select class="form-control" name="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect2">Example multiple select</label>
                        <select multiple class="form-control" name="exampleFormControlSelect2">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Example textarea</label>
                        <textarea class="form-control" name="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                            Default checkbox
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="defaultCheck2" disabled>
                        <label class="form-check-label" for="defaultCheck2">
                            Disabled checkbox
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" name="exampleRadios1" value="option1" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Default radio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" name="exampleRadios2" value="option2">
                        <label class="form-check-label" for="exampleRadios2">
                            Second default radio
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="exampleRadios" name="exampleRadios3" value="option3" disabled>
                        <label class="form-check-label" for="exampleRadios3">
                            Disabled radio
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Example file input</label>
                        <input type="file" class="form-control-file" name="exampleFormControlFile1">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>