@extends('admin.layouts')
@section('title','Categories')
@section('content')
    <form action="{{ route('categories.store') }}" id="formStoreCategory" onsubmit="createCTG(event)" class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <label for="name" class="sr-only">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="icon" class="sr-only">Icon</label>
            <input type="file" class="form-control" id="icon" name="icon" placeholder="Icon" required>
        </div>
        <button type="submit" class="btn btn-primary mb-2">Create</button>
    </form>

    <table class="table table-borderless">
        <thead>
        <tr>
            <th scope="col" width="50">#</th>
            <th scope="col" width="150">Name</th>
            <th scope="col" width="450">Icon</th>
            <th scope="col">Last Modified</th>
        </tr>
        </thead>
        <tbody id="tableCtgBody">
            
    </table>
    <div id="links"></div>
@endsection

@push('script')
<script>
    const parentSearch = document.getElementById('parentSearch');
    parentSearch.addEventListener('keyup', function (e) {
        document.getElementById('formparentSearch').addEventListener('submit', function (event) {
            event.preventDefault();
        })

        if (e.keyCode == 13) {
            searchKey(this)
        }
    })

    searchKey = (ini)=>{
        // e.preventDefault()
        alert(ini.value)
    }
</script>


<script>
    const baseUrl = document.getElementById('base_url').value
    const token = document.getElementById('csrf_token').value

    function createCTG(e) {
        e.preventDefault();
        const endpoint = baseUrl+"/categories";
        const formCTG = document.getElementById('formStoreCategory')
        const dataForm = new FormData(formCTG)
        dataForm.append('_token',token);


        axios({
            method: 'POST',
            url: endpoint,
            data: dataForm,
            // headers: {'Content-Type': 'multipart/form-data' }
        })
        .then(function (response) {
            // console.log(response.data);
            formCTG.reset();
            getctg();
        })
        .catch(function (error) {
            console.log(error);
        });
    }

    getctg()
    function getctg(params="/?page=1",e=null){
        if (e!=null) e.preventDefault();

        axios.get(baseUrl+'/categories'+params)
        .then(response => {
            // const posts = Object.entries(response.data).map((e) => ( { [e[0]]: e[1] } ));
            const categories = response.data;
            updateTableUI(categories)
        })
        .catch(error => console.error(error));
    }

    function updateTableUI(data) {
        let content = "";
        const categories = data;
        const tableBody = document.getElementById('tableCtgBody')
        no = categories.from;
        $.each(categories.data,(i,el) => {
            // el = el.name == undefined ? el[i] : el;
            content += `
            <tr>
                <th scope="row">${no++}</th>
                <td>${el.name}</td>
                <td><img class="img-thumbnail" style="width:15%" src="{{ asset('storage/app/${el.icon}') }}" alt=""></td>
                <td>${el.modified}</td>
            </tr>
            `
        });
        // console.log(content);
        tableBody.innerHTML = content

        links = generateLinks(categories.links,categories.first_page_url,categories.last_page_url);

        document.getElementById('links').innerHTML = links
    }

    function generateLinks(data,first,last) {
        let content="";
        let now = "";

        if (data) {
            data.forEach((el,i)=>{
                active = el.active ? 'active' : el.url == null ? 'disabled' : "" ;
                
                if (active === 'active') now = el.url;
    
                if (el.label === "&laquo; Previous") {
                    content += `
                    <li class="page-item ${active}">
                        <a class="page-link" href="#" onclick="getctg('${el.url}',event)" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>`
                } else if (el.label === "Next &raquo;") {
                    content += `
                    <li class="page-item ${active}">
                        <a class="page-link" href="#" onclick="getctg('${el.url}',event)" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li> `
                }else{
                    content += `
                        <li class="page-item ${active}"><a class="page-link" href="#" onclick="getctg('${el.url}',event)">${el.label}</a></li>
                    `
                }
            })
        }

        firstLink = first === now ? "" : `
        <li class="page-item">
            <a class="page-link" href="#" onclick="getctg('${first}',event)" tabindex="-1">First</a>
        </li>
        `

        lastLink = last === now ? "" : `
        <li class="page-item">
            <a class="page-link" href="#" onclick="getctg('${last}',event)" tabindex="-1">Last</a>
        </li>
        `

        let links = `
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                ${firstLink}
                ${content}
                ${lastLink}
            </ul>
        </nav>
        `

        return links;
    }

</script>
@endpush
