@if ($errors->any())

    <div class="alert alert-danger">

        <ul class="mb-0">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

<div class="row">

    <div class="col-md-12 mb-3">

        <label>Nombre / Razón social</label>

        <input type="text"
               name="name"
               class="form-control"
               value="{{ old('name', $client->name ?? '') }}"
               required>

    </div>

    <!-- DATOS FISCALES -->
    <div class="col-12">

        <h5 class="fw-bold mt-2 mb-3">Datos para factura electrónica</h5>

    </div>

    <div class="col-md-4 mb-3">

        <label>Tipo de documento</label>

        <select name="identity_document_id"
                class="form-select"
                required>

            @foreach ($identityDocuments as $id => $label)

                <option value="{{ $id }}"
                        @selected(old('identity_document_id', $client->identity_document_id ?? 1) == $id)>

                    {{ $label }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-4 mb-3">

        <label>Número de documento</label>

        <input type="text"
               name="dni"
               class="form-control"
               value="{{ old('dni', $client->dni ?? '') }}"
               placeholder="NIT sin dígito de verificación"
               required>

        @if (isset($client) && $client->dv !== null)

            <small class="text-muted">DV: {{ $client->dv }}</small>

        @endif

    </div>

    <div class="col-md-4 mb-3">

        <label>Tipo de persona</label>

        <select name="type_organization_id"
                class="form-select"
                required>

            @foreach ($organizationTypes as $id => $label)

                <option value="{{ $id }}"
                        @selected(old('type_organization_id', $client->type_organization_id ?? 2) == $id)>

                    {{ $label }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label>Régimen de IVA</label>

        <select name="tax_regime_id"
                class="form-select"
                required>

            @foreach ($taxRegimes as $id => $label)

                <option value="{{ $id }}"
                        @selected(old('tax_regime_id', $client->tax_regime_id ?? 2) == $id)>

                    {{ $label }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-6 mb-3">

        <label>Responsabilidad fiscal</label>

        <select name="tax_level_id"
                class="form-select"
                required>

            @foreach ($taxLevels as $id => $label)

                <option value="{{ $id }}"
                        @selected(old('tax_level_id', $client->tax_level_id ?? 5) == $id)>

                    {{ $label }}

                </option>

            @endforeach

        </select>

    </div>

    <!-- CONTACTO -->
    <div class="col-md-6 mb-3">

        <label>Email (recibe la factura electrónica)</label>

        <input type="email"
               name="email"
               class="form-control"
               value="{{ old('email', $client->email ?? '') }}"
               required>

    </div>

    <div class="col-md-6 mb-3">

        <label>Teléfono</label>

        <input type="text"
               name="phone"
               class="form-control"
               value="{{ old('phone', $client->phone ?? '') }}"
               required>

    </div>

    <div class="col-md-12 mb-3">

        <label>Dirección</label>

        <input type="text"
               name="address"
               class="form-control"
               value="{{ old('address', $client->address ?? '') }}"
               required>

    </div>

    <div class="col-md-8 mb-3">

        <label>Municipio</label>

        <select name="city_id"
                class="form-select"
                required>

            <option value="">Seleccionar municipio</option>

            @foreach (collect($cities)->groupBy('department') as $department => $departmentCities)

                <optgroup label="{{ $department }}">

                    @foreach ($departmentCities as $city)

                        <option value="{{ $city['id'] }}"
                                @selected(old('city_id', $client->city_id ?? null) == $city['id'])>

                            {{ $city['name'] }} ({{ $city['code'] }})

                        </option>

                    @endforeach

                </optgroup>

            @endforeach

        </select>

    </div>

    <div class="col-md-4 mb-3">

        <label>Código postal (opcional)</label>

        <input type="text"
               name="postal_code"
               class="form-control"
               maxlength="6"
               value="{{ old('postal_code', $client->postal_code ?? '') }}">

    </div>

</div>
