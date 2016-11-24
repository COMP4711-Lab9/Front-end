<!--
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
-->

<table class='table'>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
    </tr>
    {items}
    <tr>
        <td><a class="btn btn-default" role="button" href="/crud/edit/{id}">{id}</a></td>
        <td>{name}</td>
        <td>{description}</td>
    </tr>
    {/items}
</table>