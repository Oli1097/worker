<!DOCTYPE html>
<html>
<head>
    <title>Fetched Data</title>
    <!-- Add your styles or link to external stylesheet here -->
</head>
<body>
    <h1>Fetched Data</h1>
    <table>
        
        <?php
        

        if (!empty($fetchedData)) {
            foreach ($fetchedData as $result) {
                echo "
                <tr>
                    <td>" . $result['full_name'] . "</td>
                    <td>" . $result['email'] . "</td>
                    <td>" . $result['contact'] . "</td>
                    <td>" . $result['address'] . "</td>
                    <td>" . $result['rating'] . "</td>
                    <td>
                        <form action='fetch.php' method='post'>
                            <input type='hidden' name='ID' value='" . $result['ID'] . "'>
                            <label for='rating'>Rating:</label>
                            <select name='rating' id='rating'>
                                <option value='1'>1</option>
                                <option value='2'>2</option>
                                <option value='3'>3</option>
                                <option value='4'>4</option>
                                <option value='5'>5</option>
                            </select>
                            <input type='submit' value='Submit Rating'>
                        </form>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data available</td></tr>";
        }
        ?>
    </table>
</body>
</html>
