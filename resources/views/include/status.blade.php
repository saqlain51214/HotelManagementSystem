<style>
    .table tbody td.status .active {
    background: #cff6dd;
    color: #1fa750;
    }
    .table tbody td.status span {
        position: relative;
        border-radius: 30px;
        padding: 4px 10px 4px 25px;
    }
    .table tbody td.status .active:after {
        background: #23bd5a;
    }
    .table tbody td.status span:after {
        position: absolute;
        top: 9px;
        left: 10px;
        width: 10px;
        height: 10px;
        content: '';
        border-radius: 50%;
    }
    .table tbody td.status .waiting {
        background: #fdf5dd;
        color: #cfa00c;
    }
    .table tbody td.status .waiting:after {
        background: #f2be1d;
    }
</style>
{{-- <td class="status">{!! $variable == 'inactive' ? "<span class='waiting'>InActive</span>" : ($variable=='active' ? "<span class='active'>Active</span>": "")  !!}</td> --}}
<td class="status"> <span class="{{ @$variable == 'active'  ? 'active' : 'waiting' }}">{{ $variable }} </span></td>
