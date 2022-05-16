<x-app-layout>
<div>
    <form action="dashboard" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="departements" class="form-label">Départements</label>
            <select class="form-control" name="" id="departements">
                <option value=""></option>
                @foreach ($departements as $dpt)
                   <option value="">{{$dpt->nom}}</option> 
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="filieres" class="form-label">Filières</label>
            <select class="form-control" name="filieres" id="filieres">
                {{-- @foreach ($filieres as $filiere)
                   <option value="">{{$filiere->intitule}}</option> 
                @endforeach --}}
            </select>  
        </div>
        <input type="file" name="file">
       <button type="submit">Uploader</button>
    </form>
</div>
        <script>
            $(document).ready(function() {
            $('#departements').on('change', function() {
               var departementsID = $(this).val();
               if(departementsID) {
                   $.ajax({
                       url: '/getfilieres/'+departementsID,
                       type: "GET",
                       data : {"_token":"{{ csrf_token() }}"},
                       dataType: "json",
                       success:function(data)
                       {
                         if(data){
                            $('#filieres').empty();
                            $('#filieres').append('<option hidden>Choose Course</option>'); 
                            $.each(data, function(key, filieres){
                                $('select[name="filieres"]').append('<option value="'+ key +'">' + filieres.intitule+ '</option>');
                            });
                        }else{
                            $('#filieres').empty();
                        }
                     }
                   });
               }else{
                 $('#filiere').empty();
               }
            });
            });
        </script>
</x-app-layout>