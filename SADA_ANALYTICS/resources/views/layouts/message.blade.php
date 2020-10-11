
@if (!empty($data['message']))
@if (substr($data["message"], 0, 5) == "error" or substr($data["message"], 0, 5) == "Error")
    <div class="alert alert-danger alert-block">
@elseif (substr($data["message"], 0, 5) == "Exito" or substr($data["message"], 0, 7) == "Success")
    <div class="alert alert-success alert-block">
@else 
    <div class="alert alert-warning alert-block">
@endif
    <button type="button" class="close" data-dismiss="alert">×</button>    
    <strong>{{ $data["message"] }}</strong>
    </div>
@endif