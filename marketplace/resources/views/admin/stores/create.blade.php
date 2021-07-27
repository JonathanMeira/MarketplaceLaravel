<h1>
    Create Store
</h1>

<form action="/admin/stores/store" method="post">
<input type="hidden" name="_token" value="{{csrf_token()}}">

<div>
    <label>Store name</label>
    <input type="text" name="name">
</div>
<div>
    <label for="">Description</label>
    <input type="text" name="description">
</div>
<div>
    <label for="">Telephone</label>
    <input type="text" name="phone">
</div>
<div>
    <label for="">Mobile phone</label>
    <input type="text" name="mobile_phone">
</div>
<div>
    <label for="">Slug</label>
    <input type="text" name="slug">
</div>
<div>
    <label for="">User</label>
    <select name="user">
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
</div>
<div>
    <button type="submit">Create new store</button>
</div>


</form>