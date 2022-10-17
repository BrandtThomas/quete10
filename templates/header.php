<header class="container mb-5">
        <a href="index.php"><img src="img/home.png" height="40" alt="Home"></a>
        <nav class="navbar sticky-top justify-content-between text-center">

            <div class="col-12 col-sm-6">

                <h2 class="text-light">Table</h2>

                <form method="POST">
                    <input type="submit" name="tableCreate" class="btn btn-primary" value="Create"></input>
                    <input type="submit" name="tableRead" class="btn btn-primary" value="Read"></input>
                    <input type="submit" name="tableVider" class="btn btn-primary" value="Vider"></input>
                    <input type="submit" name="tableDelete" class="btn btn-primary" value="Delete"></input>
                </form>
            </div>

            <div class=" col-12 col-sm-6">
                <h2 class="text-light">Champion</h2>
                <form method="POST">
                    <div class="mb-1">
                    <input type="submit" name="champRead" class="btn btn-primary" value="Read one"></input>
                    <input type="submit" name="champReadAge" class="btn btn-primary" value="Read by Age"></input>
                    <input type="submit" name="champTransformHulk" class="btn btn-primary" value="Transform"></input>
                    <input type="submit" name="champDeleteRand" class="btn btn-primary" value="Delete rand"></input>
                    </div>
                    <div class="mt-1">
                    <input type="submit" name="champCreateForm" class="btn btn-primary" value="Create Form">
                    <input type="submit" name="createAll" class="btn btn-primary" value="Create All">
                    </div>
                </form>
            </div>
        </nav>

    </header>