<?php include('admin.php');?>
<?php include('database.php');?>
<div class="container">
       <h1>Donation requests</h1>
       
      <table id = "donationRequestTable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>donation id</th>
                <th>Username</th>
                <th>Blood Group</th>
                <th>Units</th>
                <th>Disease</th>
                <th>date</th>
                <th>phone number</th>
                <th>Status requests</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $qery = "SELECT * from "
            ?>
            <tr>
                <td>{{ donor[0] }}</td>
                <td>{{ donor[1] }}</td>
                <td>{{ donor[2] }}</td>
                <td>{{ donor[3] }}</td>
                <td>{{ donor[4] }}</td>
                <td>{{ donor[5] }}</td>
                <td>{{ donor[6] }}</td>
                <td>
                    {% if donor[7] == 'accepted' or donor[7]== 'rejected' %}
                        <span>{{ donor[7] }} </span>
                    
                        <form action="{{ url_for('accept_donor', donation_id=donor[0]) }}" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-outline-success btn-sm">Accept</button>
                        </form>
                        <form action="{{ url_for('delete', donation_id=donor[0]) }}" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-outline-danger btn-sm mx-2">Reject</button>
                        </form>
                    
                </td>
            </tr>
            
        </tbody>
    </table>
     </div>

<?php include('footer.php');?>