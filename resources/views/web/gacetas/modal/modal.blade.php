@foreach($cetas as $ceta)
<div class="modal fade modal-qr" id="qrModal-{{ $ceta->id }}" tabindex="-1" aria-labelledby="qrModalLabel-{{ $ceta->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel-{{ $ceta->id }}">Código QR - {{ $ceta->nombre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- QR con logo de la empresa -->
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=400x400&data={{ urlencode(asset(Storage::url($ceta->ruta))) }}&logo={{ urlencode(asset('img/logo.png')) }}&logoSize=80000x80&logoMargin=5" 
                     alt="QR Code para {{ $ceta->nombre }}" class="img-fluid qr-image">
                     
                <p class="mt-3 alert alert-warning fw-bold text-center">
                    <i class="fas fa-mobile-alt me-2"></i> Escanea este código para descargar la gaceta en tu dispositivo móvil
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach