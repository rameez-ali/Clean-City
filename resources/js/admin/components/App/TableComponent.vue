<template>
    
          <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                  <tr>
                                    <th>S.No</th>
                                    <th>Employee Name</th>
                                    <th>Email</th>
                                    <th>Registration Date</th>
                                    <th>Action</th>
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>01</td>
                                    <td><span data-toggle="popover" data-content="johny" class="circle" style="background: #f61454;">M</span>Mark William</td>
                                    <td>abc@testmail.com</td>
                                    <td>Dec-03-2019</td>
                                    <td>
                                      <div class="btn-group mr-1 mb-1">
                                        <button type="button" class="btn  btn-drop-table btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-ellipsis-v"></i></button>
                                        <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(4px, 23px, 0px); top: 0px; left: 0px; will-change: transform;">
                                          <a class="dropdown-item" href="a-employee-profile.html"><i class="fa fa-eye"></i>View </a>
                                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-ban" aria-hidden="true"></i>block</a>
                                          <a class="dropdown-item" href="a-employees-ticket-log.html"><i class="fa fa-ticket"></i>View Ticket Log</a>

                                        </div>
                                      </td>
                                    </tr>
                                    
                                    
</tbody>
</table>
    
</template>

<script>
export default {
    props:{
        thead:Array,
        tableRows:Array
    }
};
</script>

<style></style>
