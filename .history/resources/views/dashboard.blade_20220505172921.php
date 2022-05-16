<x-app-layout>
<div class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header"></div>
            <div class="modal-body">
                <form action="dashboard" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="departements" class="form-label">Départements</label>
                        <select class="form-control" name="" id="departements" required>
                            <option value="">choisir un Départements</option>
                            @foreach ($departements as $dpt)
                               <option value="{{$dpt->id}}">{{$dpt->nom}}</option> 
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="filieres" class="form-label">Filières</label>
                        <select class="form-control" name="filieres" id="filieres" required>
                                {{-- options filieres --}}
                        </select>  
                    </div>
                    <div class="mb-3">
                        <label for="matieres" class="form-label">Matieres</label>
                        <select class="form-control" name="matieres" id="matieres" required>
                            {{-- options matieres --}}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="niveaux"  class="form-label">Niveaux</label>
                        <select name="" id="niveaux" class="form-control" required>
                            <option value="">choisir un Niveau*</option>
                            <option value="dut1-dst1">dut1-dst1</option>
                            <option value="dut2-dst2">dut2-dst2</option>
                            <option value="dic1-licence">dic1-licence</option>
                            <option value="dic2-master1">dic2-master1</option>
                            <option value="dic3-master2">dic3-master2</option>
                        </select>
                    </div>
                    <input type="file" name="file">
                   <button type="submit">Uploader</button>
                </form>
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#uploader">
    Launch demo modal
</button>


{{-- javascript --}}
    <script>
                $(document).ready(function () {
                $('#departements').on('change', function () {
                let id = $(this).val();
                $('#filieres').empty();
                $('#filieres').append('<option value="0" disabled selected>Processing...</option>');
                $.ajax({
                type: 'get',
                url: '/getfiliere/' + id,
                success: function (response) {
                    console.log(response);   
                $('#filieres').empty();
                $('#filieres').append(`<option value="0" disabled selected>choisir une Filière*</option>`);
                response.forEach(element => {
                    $('#filieres').append(`<option value="${element['id']}">${element['intitule']}</option>`);
                    });
                }
            });
        });
    });
    </script>
    <script>
            $(document).ready(function () {
                $('#filieres').on('change', function () {
                let id = $(this).val();
                $('#matieres').empty();
                $('#matieres').append('<option value="0" disabled selected>Processing...</option>');
                $.ajax({
                type: 'get',
                url: '/getmatiere/' + id,
                success: function (response) {
                    console.log(response);   
                $('#matieres').empty();
                $('#matieres').append(`<option value="0" disabled selected>choisir une Matiere*</option>`);
                response.forEach(element => {
                    $('#matieres').append(`<option value="${element['id']}">${element['nom_matiere']}</option>`);
                    });
                }
            });
        });
    });
    </script>
</x-app-layout>