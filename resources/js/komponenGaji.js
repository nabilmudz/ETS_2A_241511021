document.addEventListener("DOMContentLoaded", function () {
    const anggotaSelect = document.getElementById("anggota-select");
    const anggotaHidden = document.getElementById("anggota-selected"); // hidden input kalau edit
    const komponenSelect = document.getElementById("komponen-select");

    function loadKomponen(jabatan, selectedKomponenId = null) {
        fetch(`/dashboard/admin/komponen-gaji/by-jabatan/${jabatan}`)
            .then(res => res.json())
            .then(data => {
                komponenSelect.innerHTML = `<option value="">-- Pilih Komponen --</option>`;
                data.forEach(k => {
                    komponenSelect.innerHTML += `
                        <option value="${k.id_komponen_gaji}" ${selectedKomponenId == k.id_komponen_gaji ? 'selected' : ''}>
                            ${k.nama_depan}
                        </option>`;
                });
            });
    }

    if (anggotaSelect) {
        anggotaSelect.addEventListener("change", function () {
            const jabatan = this.options[this.selectedIndex].dataset.jabatan;
            loadKomponen(jabatan);
        });
    }

    if (anggotaHidden) {
        const jabatan = anggotaHidden.dataset.jabatan;
        const selectedKomponenId = komponenSelect.dataset.selected;
        loadKomponen(jabatan, selectedKomponenId);
    }
});
