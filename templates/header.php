<body class="<?php if (isset($_COOKIE['sticky'])) { echo$_COOKIE['sticky']; } else { echo "true";} ?>">
<header class="<?php if (isset($_COOKIE['sticky'])) { echo$_COOKIE['sticky']; } else { echo "true";} ?>">
    <table style="width: 100%;">
        <tr>
            <td style="width: 83px;"><a href="./index"><button><img src="./lt2.png" width="80px"></button></a></td>
            <td>
                <h2>LT2 Pricing Sheet</h2>
                <a href="./index"><button>Home</button></a>
                <a href="./wood"><button>Wood</button></a>
                <a href="./items"><button>Items</button></a>
                <a href="./service"><button>Service</button></a>
                <a href="./settings"><button><img src="https://img.icons8.com/?size=100&id=2969&format=png&color=FFFFFF" height="12px"></button></a>
            </td>
        </tr>
    </table>

    <div class="searchDiv">
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search [<?php echo $_SERVER['REQUEST_URI'] ?>].." title="Filter the list">
    </div>
</header>

<h2>Viewing: <?php echo $_SERVER['REQUEST_URI'] ?></h2>