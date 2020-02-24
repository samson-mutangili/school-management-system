@extends('layouts.dashboard')


@section('content')

<p> student details will be here</p>

<ul class="nav nav-tabs" style="border: 1px solid black; border-radius: 5px;">
        <li class="active" style="margin-left: 20px; margin-right: 30px;"><a data-toggle="tab" href="#home">Home</a></li>
        <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
</ul>
      
      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>HOME</h3>

<table class="table table-hover">
        <thead class="active">
            <th class="table-secondary">S/NO</th>
            <th class="table-secondary">Name</th>
            <th class="table-secondary">Phone no.</th>
            <th class="table-secondary">TSC no.</th>
            <th class="table-secondary">Email</th>
        </thead>
    
        <tbody>
            <tr>
                <td>1</td>
                <td>Samson mutangili</td>
                <td>07394882</td>
                <td>697724</td>
                <td>samkimole@gmail.com</td>
            </tr>
    
            <tr>
                    <td>2</td>
                    <td>Mary Mwang1</td>
                    <td>89237322</td>
                    <td>343435</td>
                    <td>marymwangi@gmail.com</td>
                </tr>
    
                <tr>
                        <td>3</td>
                        <td>Shantel kamanthe</td>
                        <td>076732843</td>
                        <td>342343</td>
                        <td>shantelkamanthe@gmail.com</td>
                    </tr>
    
                    <tr>
                            <td>4</td>
                            <td>JUstus muoka</td>
                            <td>8297745445</td>
                            <td>438374</td>
                            <td>justusmuoka@gmail.com</td>
                        </tr>
        </tbody>
</table>
        </div>
        <div id="menu1" class="tab-pane fade">
          <h3>Menu 1</h3>

<table class="table table-hover">
        <thead class="active">
            <th class="table-secondary">S/NO</th>
            <th class="table-secondary">Name</th>
            <th class="table-secondary">Phone no.</th>
            <th class="table-secondary">TSC no.</th>
            <th class="table-secondary">Email</th>
        </thead>
    
        <tbody>
            <tr>
                <td>1</td>
                <td>Samson mutangili</td>
                <td>07394882</td>
                <td>697724</td>
                <td>samkimole@gmail.com</td>
            </tr>
    
            <tr>
                    <td>2</td>
                    <td>Mary Mwang1</td>
                    <td>89237322</td>
                    <td>343435</td>
                    <td>marymwangi@gmail.com</td>
                </tr>
    
        </tbody>
</table>
        </div>
      </div>
    
@endsection