@extends('layouts.app')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous" />
    <div class="container">
        <h1>Classes</h1>
        <a href="{{ route('classes.create') }}" class="btn btn-primary mb-3">Create Class</a>
        <div class="alert-container"></div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created By</th>
                    <th>Assign Lecture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->id }}</td>
                        <td>
                            <a href="{{ route('class.show', ['class' => $class->id]) }}">
                                {{ $class->class_name }}
                            </a>
                        </td>

                        <td>{{ $class->user->name }}</td>
                        <td>
                            <div class="dropdown">
                                <select name="lecture_ids[]" class="form-control dropdown"
                                    data-class-id="{{ $class->id }}" id="field1" multiple multiselect-hide-x="true"
                                    style="width: 250px;">
                                    @foreach ($lectures as $lecture)
                                        <option value="{{ $lecture->id }}"
                                            {{ in_array($lecture->id, $class->lecture_ids ?? []) ? 'selected' : '' }}>
                                            {{ $lecture->lecture_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button class="btn btn-dark"
                                    onclick="updateClassModelLecture(this, {{ $class->id }}, $('select[name=\'lecture_ids[]\']').val())">Assign</button>
                            </div>


                        </td>
                        <td>
                            <a href="{{ route('classes.edit', $class->id) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('classes.destroy', $class->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this class?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function updateClassModelLecture(buttonElement, classId, lectureIds) {
            var selectedLectureIds = $(buttonElement).closest('.dropdown').find('select[name="lecture_ids[]"]').val();

            $.ajax({
                url: '/update-class-model-lecture',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    classId: classId,
                    lectureIds: selectedLectureIds // Pass the array of lecture IDs
                },
                success: function(response) {
                    showAlert('success', 'Lectures assigned successfully.');
                    // window.location.href = '{{ route('classes.index') }}';
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
    <script>
        function showAlert(type, message) {
            let alertDiv = $('<div>').addClass('alert alert-' + type).text(message);
            $('.alert-container').append(alertDiv);

            // Automatically remove the alert after 2 seconds
            setTimeout(function() {
                alertDiv.fadeOut(500, function() {
                    $(this).remove();
                });
            }, 2000);
        }
    </script>
    <script>
        function updateLectureDropdown(classId, selectedValue) {
            let dropdown = $('select[name="class_id"][data-class-id="' + classId + '"]');
            dropdown.val(selectedValue); // Set the selected value

            // Update the option text
            dropdown.find('option').each(function() {
                if ($(this).val() === selectedValue) {
                    $(this).text(selectedValue);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            // Hide the success message after 2 seconds
            setTimeout(function() {
                $('#success-message').fadeOut('slow');
            }, 2000);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>


    <script>
        var style = document.createElement("style");
        style.setAttribute("id", "multiselect_dropdown_styles");
        style.innerHTML = `
  .multiselect-dropdown{
    display: inline-block;
    padding: 2px 5px 0px 5px;
    border-radius: 4px;
    border: solid 1px #ced4da;
    background-color: white;
    position: relative;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right .75rem center;
    background-size: 16px 12px;
  }
  .multiselect-dropdown span.optext, .multiselect-dropdown span.placeholder{
    margin-right:0.5em;
    margin-bottom:2px;
    padding:1px 0;
    border-radius: 4px;
    display:inline-block;
  }
  .multiselect-dropdown span.optext{
    background-color:lightgray;
    padding:1px 0.75em;
  }
  .multiselect-dropdown span.optext .optdel {
    float: right;
    margin: 0 -6px 1px 5px;
    font-size: 0.7em;
    margin-top: 2px;
    cursor: pointer;
    color: #666;
  }
  .multiselect-dropdown span.optext .optdel:hover { color: #c66;}
  .multiselect-dropdown span.placeholder{
    color:#ced4da;
  }
  .multiselect-dropdown-list-wrapper{
    box-shadow: gray 0 3px 8px;
    z-index: 100;
    padding:2px;
    border-radius: 4px;
    border: solid 1px #ced4da;
    display: none;
    margin: -1px;
    position: absolute;
    top:0;
    left: 0;
    right: 0;
    background: white;
  }
  .multiselect-dropdown-list-wrapper .multiselect-dropdown-search{
    margin-bottom:5px;
  }
  .multiselect-dropdown-list{
    padding:2px;
    height: auto;
    overflow-y:auto;
    overflow-x: hidden;
  }
  .multiselect-dropdown-list::-webkit-scrollbar {
    width: 6px;
  }
  .multiselect-dropdown-list::-webkit-scrollbar-thumb {
    background-color: #bec4ca;
    border-radius:3px;
  }

  .multiselect-dropdown-list div{
    padding: 5px;
  }
  .multiselect-dropdown-list input{
    height: 1.15em;
    width: 1.15em;
    margin-right: 0.35em;
  }
  .multiselect-dropdown-list div.checked{
  }
  .multiselect-dropdown-list div:hover{
    background-color: #ced4da;
  }
  .multiselect-dropdown span.maxselected {width:100%;}
  .multiselect-dropdown-all-selector {border-bottom:solid 1px #999;}
  `;
        document.head.appendChild(style);

        function MultiselectDropdown(options) {
            var config = {
                search: true,
                height: "auto",
                placeholder: "select",
                txtSelected: "selected",
                txtAll: "All",
                txtRemove: "Remove",
                txtSearch: "search",
                ...options,
            };

            function newEl(tag, attrs) {
                var e = document.createElement(tag);
                if (attrs !== undefined)
                    Object.keys(attrs).forEach((k) => {
                        if (k === "class") {
                            Array.isArray(attrs[k]) ?
                                attrs[k].forEach((o) => (o !== "" ? e.classList.add(o) : 0)) :
                                attrs[k] !== "" ?
                                e.classList.add(attrs[k]) :
                                0;
                        } else if (k === "style") {
                            Object.keys(attrs[k]).forEach((ks) => {
                                e.style[ks] = attrs[k][ks];
                            });
                        } else if (k === "text") {
                            attrs[k] === "" ?
                                (e.innerHTML = "&nbsp;") :
                                (e.innerText = attrs[k]);
                        } else e[k] = attrs[k];
                    });
                return e;
            }

            document.querySelectorAll("select[multiple]").forEach((el, k) => {
                var div = newEl("div", {
                    class: "multiselect-dropdown",
                    style: {
                        width: config.style?.width ?? el.clientWidth + "px",
                        padding: config.style?.padding ?? "",
                    },
                });
                el.style.display = "none";
                el.parentNode.insertBefore(div, el.nextSibling);
                var listWrap = newEl("div", {
                    class: "multiselect-dropdown-list-wrapper",
                });
                var list = newEl("div", {
                    class: "multiselect-dropdown-list",
                    style: {
                        height: config.height
                    },
                });
                var search = newEl("input", {
                    class: ["multiselect-dropdown-search"].concat([
                        config.searchInput?.class ?? "form-control",
                    ]),
                    style: {
                        width: "100%",
                        display: el.attributes["multiselect-search"]?.value === "true" ?
                            "block" : "none",
                    },
                    placeholder: config.txtSearch,
                });
                listWrap.appendChild(search);
                div.appendChild(listWrap);
                listWrap.appendChild(list);

                el.loadOptions = () => {
                    list.innerHTML = "";

                    if (el.attributes["multiselect-select-all"]?.value == "true") {
                        var op = newEl("div", {
                            class: "multiselect-dropdown-all-selector",
                        });
                        var ic = newEl("input", {
                            type: "checkbox"
                        });
                        op.appendChild(ic);
                        op.appendChild(newEl("label", {
                            text: config.txtAll
                        }));

                        op.addEventListener("click", () => {
                            op.classList.toggle("checked");
                            op.querySelector("input").checked = !op.querySelector("input").checked;

                            var ch = op.querySelector("input").checked;
                            list
                                .querySelectorAll(
                                    ":scope > div:not(.multiselect-dropdown-all-selector)"
                                )
                                .forEach((i) => {
                                    if (i.style.display !== "none") {
                                        i.querySelector("input").checked = ch;
                                        i.optEl.selected = ch;
                                    }
                                });

                            el.dispatchEvent(new Event("change"));
                        });
                        ic.addEventListener("click", (ev) => {
                            ic.checked = !ic.checked;
                        });
                        el.addEventListener("change", (ev) => {
                            let itms = Array.from(
                                list.querySelectorAll(
                                    ":scope > div:not(.multiselect-dropdown-all-selector)"
                                )
                            ).filter((e) => e.style.display !== "none");
                            let existsNotSelected = itms.find(
                                (i) => !i.querySelector("input").checked
                            );
                            if (ic.checked && existsNotSelected) ic.checked = false;
                            else if (ic.checked == false && existsNotSelected === undefined)
                                ic.checked = true;
                        });

                        list.appendChild(op);
                    }

                    Array.from(el.options).map((o) => {
                        var op = newEl("div", {
                            class: o.selected ? "checked" : "",
                            optEl: o,
                        });
                        var ic = newEl("input", {
                            type: "checkbox",
                            checked: o.selected,
                        });
                        op.appendChild(ic);
                        op.appendChild(newEl("label", {
                            text: o.text
                        }));

                        op.addEventListener("click", () => {
                            op.classList.toggle("checked");
                            op.querySelector("input").checked = !op.querySelector("input")
                                .checked;
                            op.optEl.selected = !!!op.optEl.selected;
                            el.dispatchEvent(new Event("change"));
                        });
                        ic.addEventListener("click", (ev) => {
                            ic.checked = !ic.checked;
                        });
                        o.listitemEl = op;
                        list.appendChild(op);
                    });
                    div.listEl = listWrap;

                    div.refresh = () => {
                        div
                            .querySelectorAll("span.optext, span.placeholder")
                            .forEach((t) => div.removeChild(t));
                        var sels = Array.from(el.selectedOptions);
                        if (
                            sels.length >
                            (el.attributes["multiselect-max-items"]?.value ?? 5)
                        ) {
                            div.appendChild(
                                newEl("span", {
                                    class: ["optext", "maxselected"],
                                    text: sels.length + " " + config.txtSelected,
                                })
                            );
                        } else {
                            sels.map((x) => {
                                var c = newEl("span", {
                                    class: "optext",
                                    text: x.text,
                                    srcOption: x,
                                });
                                if (el.attributes["multiselect-hide-x"]?.value !== "true")
                                    c.appendChild(
                                        newEl("span", {
                                            class: "optdel",
                                            text: "🗙",
                                            title: config.txtRemove,
                                            onclick: (ev) => {
                                                c.srcOption.listitemEl.dispatchEvent(
                                                    new Event("click")
                                                );
                                                div.refresh();
                                                ev.stopPropagation();
                                            },
                                        })
                                    );

                                div.appendChild(c);
                            });
                        }
                        if (0 == el.selectedOptions.length)
                            div.appendChild(
                                newEl("span", {
                                    class: "placeholder",
                                    text: el.attributes["placeholder"]?.value ?? config.placeholder,
                                })
                            );
                    };
                    div.refresh();
                };
                el.loadOptions();

                search.addEventListener("input", () => {
                    list
                        .querySelectorAll(
                            ":scope div:not(.multiselect-dropdown-all-selector)"
                        )
                        .forEach((d) => {
                            var txt = d.querySelector("label").innerText.toUpperCase();
                            d.style.display = txt.includes(search.value.toUpperCase()) ?
                                "block" :
                                "none";
                        });
                });

                div.addEventListener("click", () => {
                    div.listEl.style.display = "block";
                    search.focus();
                    search.select();
                });

                document.addEventListener("click", function(event) {
                    if (!div.contains(event.target)) {
                        listWrap.style.display = "none";
                        div.refresh();
                    }
                });
            });
        }

        window.addEventListener("load", () => {
            MultiselectDropdown(window.MultiselectDropdownOptions);
        });
    </script>
@endsection
