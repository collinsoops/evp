<?php
//session_start();
	require_once('sessioncheck.php');
	//require_once('checkelection.php');
$el=$_SESSION['id'];

$page='voters';
$sort_variable = "user_id";

	?>

<!DOCTYPE html>
<html :class="{'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Voters</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>

    <script src="src/facebox.js" type="text/javascript"></script>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
    < script type = "text/javascript" >
        jQuery(document).ready(function($) {
            $('a[rel*=facebox]').facebox({
                loadingImage: 'src/loading.gif',
                closeImage: 'src/closelabel.png'
            })
        })
    </script>



</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <!-- Desktop sidebar -->
        <?php include '../conn.php'; ?>
        <?php include 'aside.php'; ?>


        <main class="h-full pb-16 overflow-y-auto">
            <div class="container grid px-6 mx-auto">
                <h4 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                    Voters </h4>

                <a href="addvoters.php">
                    <input type="button" value="Add New Voter"
                        class="bg-purple-600 w-30  hover:bg-purple-700 text-white font-bold py-1 px-3 rounded shadow-lg items-center hover:shadow-xl transition duration-200 float-right" />

                </a>

                <div class="w-full overflow-hidden rounded-lg shadow-xs">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full whitespace-no-wrap">
                            <thead>
                                <tr
                                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                    <th class="px-4 py-3">Profile</th>
                                    <th class="px-4 py-3">Username</th>

                                    <th class="px-4 py-3">Type</th>
                                    <th class="px-4 py-3">Status</th>

                                    <th class="px-4 py-3">Actions</th>
                                </tr>
                            </thead>


                            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">

                                <?php




$results_per_page = 10;
	
	
if (isset($_GET["page"])) 
{ $page  = $_GET["page"]; } 
else { $page=1; };
$start_from = ($page-1) * $results_per_page;

if((isset($_POST['sort_var']))){
	$sort_variable = $_POST['sort_var'];	
	//$sortType = $_POST['sort_type'];
}

					
					    $result = $conn->prepare("SELECT * FROM users WHERE election_id= $el  ORDER BY $sort_variable  LIMIT $start_from, ".$results_per_page );
					//	$result->bindParam(':el', $el);
				
						//$result = $conn->prepare("SELECT * FROM users");
						$result->execute();
						for($i=0; $row = $result->fetch(); $i++){
					?>

                                <tr class="text-gray-700 dark:text-gray-400">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center text-sm">
                                            <!-- Avatar with inset shadow -->
                                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                <img class="object-cover w-full h-full rounded-full"
                                                    src="../img/candidate/<?php echo $row['photo']; ?>" alt=""
                                                    loading="lazy" />
                                                <div class="absolute inset-0 rounded-full shadow-inner"
                                                    aria-hidden="true"></div>
                                            </div>
                                            <div>
                                                <p class="font-semibold"><?php echo $row['firstname']; ?>
                                                    <?php echo $row['lastname']; ?></p>
                                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                                    <?php echo $row['username']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php echo $row['username']; ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php 
					 
					 $type= $row['user_type_id']; 
					 
					 $results = $conn->prepare("SELECT * FROM usertype WHERE user_type_id= :type");
	$results->bindParam(':type', $type);
	$results->execute();
	$rows2 = $results->fetch();
echo $rows2['user_type_name']; 
					 
					?>


                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php echo $row['username']; ?>
                                    </td>

                                    <td class="px-4 py-3">
                                        <div class="flex items-center space-x-4 text-sm">
                                            <a rel="facebox" href="editvoter.php?id= <?php echo $row['user_id']; ?>">
                                                <button
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                    aria-label="Edit">
                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                        </path>
                                                    </svg>
                                                </button>

                                                <button id="<?php echo $row['user_id']; ?>" title="Click To Delete"
                                                    name="delbutton"
                                                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray delbutton"
                                                    aria-label="Delete">




                                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                        </div>
                                    </td>
                                </tr>

                                <?php
				   }
				   ?>
                            </tbody>
                        </table>
                    </div>




                    <?php
$query = $conn->prepare("SELECT * FROM users WHERE election_id= $el ");
		  //$sql = "SELECT userId AS total FROM users ";
    //  $query = $conn->prepare($sql);

      $query ->execute();
      $row = $query->rowCount();

$total_pages = ceil($row / $results_per_page); // calculate total pages with results
?>

                    <div
                        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                        <span class="flex items-center col-span-3">
                            Showing <?php echo $results_per_page;?> of <?php echo $row    ?>
                        </span>
                        <span class="col-span-2"></span>



                        <?php
for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages

  ?>
                        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                            <nav aria-label="Table navigation">
                                <ul class="inline-flex items-center">
                                    <li>
                                        <button
                                            class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                                            aria-label="Previous">
                                            <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                                <path
                                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </li>

                                    <?php


         echo " <a href='voters.php?page=".$i."'";

            if ($i==$page)  echo " class='curPage'";

?>
                                    >
                                    <li>
                                        <button
                                            class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">

                                            <?php   echo $i;  ?>


                                        </button>
                                    </li>
                                    </a>

                                    <?php

                                    }
                                    ?>

                                    <li>
                                        <button
                                            class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                                            aria-label="Next">
                                            <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                                <path
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                            </nav>
                        </span>
                    </div>
                </div>
            </div>
        </main>
    </div>
    </div>
</body>

</html>


<script src="js/jquery.js"></script>
<script type="text/javascript">
$(function() {


    $(".delbutton").click(function() {

        //Save the link in a variable called element
        var element = $(this);

        //Find the id of the link that was clicked
        var del_id = element.attr("id");

        //Built a url to send
        var info = 'id=' + del_id;
        if (confirm("Sure you want to delete this voter? There is NO undo!")) {

            $.ajax({
                type: "GET",
                url: "deletevoter.php",
                data: info,
                success: function() {

                }
            });
            $(this).parents(".record").animate({
                    backgroundColor: "#fbc7c7"
                }, "fast")
                .animate({
                    opacity: "hide"
                }, "slow");

        }

        return false;

    });

});
</script>