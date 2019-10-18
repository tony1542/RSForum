<?php
use App\Http\Session;
?>

<?php if (isset($_SESSION['username'])) : ?>
    <div class="alert alert-success" role="alert">
        Welcome, <?= Session::flash('username') ?>!
    </div>
<?php endif; ?>

<div class="d-flex justify-content-center">
    <div class="card col-md-6">
        <div class="card-body">
            <h5 class="card-title">Fremennik Exiles</h5>
            <h6 class="card-subtitle mb-2 text-muted">From the creators of Fremennik isles...</h6>
            <p class="card-text">
                The Fremennik Exiles is an upcoming quest in the Fremennik quest series.
                First pitched in early 2017, development on the quest was done in Mod Ed and Wolf"s personal project time, with a large chunk of the quest
                being completed before personal projects were cancelled in mid 2018, halting development of the quest until August 2019.
            </p>

            <div class="row">
                <div class="col-sm">
                    <a href="https://www.reddit.com/r/2007scape/comments/d6g3hc/fremennik_exiles_is_next_week/" class="card-link" target="_blank">Reddit Link</a>
                </div>
                <div class="col-sm d-flex justify-content-end">
                    <a href="https://oldschool.runescape.wiki/w/The_Fremennik_Exiles/Quick_guide" class="card-link" target="_blank"> Quick Guide</a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="d-flex justify-content-center">
    <div class="card col-md-6">
        <div class="card-body">
            <h5 class="card-title">OSRS Reveals - Group Ironman</h5>
            <h6 class="card-subtitle mb-2 text-muted">What is Group Ironman?</h6>
            <p class="card-text">
                As a fresh Group Ironman you'll be able to join a group of two to five players. You and your group will earn your items and supplies together, without trading with any other players.
                Everyone will be on a fresh playing field with the release of Group Ironman. Four different HiScore races will begin at once! Each group size will have their own HiScores table.
                If you've chosen to be a Group Ironman you'll be placed in a penned off area upon completion of the tutorial. Here, similar to Barbarian Assault, you'll find other potential members of your group.
                The more people there are, the easier it is to gather items and achieve goals. Your group can always increase in size (up to five players), but cannot decrease. We don't want players to gain an advantage with a bigger group and then move down to a more competitive bracket.
                With the proposed clan system, each group will have their own secure chat channel separate from the existing channels.
                Each group will have a group leader. The group leader will have the power to initiate a vote to remove someone from the group. In the event of a tie, the group leader will decide the outcome. If you are removed from the group you will remain a Group Ironman but will have to recruit more members to your own newly-formed group.</p>
                <p><b>Why should you play Group Ironman?</b><br/>
                A lot of you have told us that you'd love to play with your group of friends! The game mode lends itself to a whole host of new strategies which aren't possible in any of the other Ironman modes.
                Delegate the workload. One person can be the potionmaster of the group, another can craft all the jewellery, someone else can train Slayer to obtain powerful weapons, all while somebody else is cooking food for the group!
            </p>

            <div class="row">
                <div class="col-sm">
                    <a href="https://secure.runescape.com/m=news/osrs-reveals---morytania-expansion-clans-and-group-ironman?oldschool=1" class="card-link" target="_blank">Click to find out more</a>
                </div>
                <div class="col-sm d-flex justify-content-end">
                </div>
            </div>
        </div>
    </div>
</div>