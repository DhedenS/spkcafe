<x-app-layout>
    <div class="py-8 bg-slate-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <h1 class="text-4xl font-bold text-slate-900 mt-2">
                    Data Kriteria
                </h1>

                <p class="text-slate-500 mt-3">
                    Informasi kriteria, tipe, bobot, dan detail range penilaian dalam metode Weighted Product.
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8 mb-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">
                    Data Kriteria Weighted Product
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-slate-200 bg-slate-50">
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Kode</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Nama Kriteria</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Bobot</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Tipe</th>
                                <th class="py-4 px-4 text-left text-slate-900 font-bold">Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="border-b border-slate-100">
                                <td class="py-5 px-4 text-slate-700">C1</td>
                                <td class="py-5 px-4 font-semibold text-slate-900">Suasana</td>
                                <td class="py-5 px-4 text-slate-700">1 - 3</td>
                                <td class="py-5 px-4">
                                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Benefit
                                    </span>
                                </td>
                                <td class="py-5 px-4 text-slate-700">Semakin nyaman semakin baik</td>
                            </tr>

                            <tr class="border-b border-slate-100">
                                <td class="py-5 px-4 text-slate-700">C2</td>
                                <td class="py-5 px-4 font-semibold text-slate-900">Harga</td>
                                <td class="py-5 px-4 text-slate-700">1 - 3</td>
                                <td class="py-5 px-4">
                                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Cost
                                    </span>
                                </td>
                                <td class="py-5 px-4 text-slate-700">Semakin murah semakin baik</td>
                            </tr>

                            <tr class="border-b border-slate-100">
                                <td class="py-5 px-4 text-slate-700">C3</td>
                                <td class="py-5 px-4 font-semibold text-slate-900">Jarak</td>
                                <td class="py-5 px-4 text-slate-700">1 - 3</td>
                                <td class="py-5 px-4">
                                    <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Cost
                                    </span>
                                </td>
                                <td class="py-5 px-4 text-slate-700">Semakin dekat semakin baik</td>
                            </tr>

                            <tr class="border-b border-slate-100">
                                <td class="py-5 px-4 text-slate-700">C4</td>
                                <td class="py-5 px-4 font-semibold text-slate-900">Parkiran</td>
                                <td class="py-5 px-4 text-slate-700">1 - 3</td>
                                <td class="py-5 px-4">
                                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Benefit
                                    </span>
                                </td>
                                <td class="py-5 px-4 text-slate-700">Semakin luas semakin baik</td>
                            </tr>

                            <tr>
                                <td class="py-5 px-4 text-slate-700">C5</td>
                                <td class="py-5 px-4 font-semibold text-slate-900">Wifi</td>
                                <td class="py-5 px-4 text-slate-700">1 - 3</td>
                                <td class="py-5 px-4">
                                    <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-bold">
                                        Benefit
                                    </span>
                                </td>
                                <td class="py-5 px-4 text-slate-700">Semakin cepat semakin baik</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-8">
                <h2 class="text-2xl font-bold text-slate-900 mb-6">
                    Detail Penilaian Kriteria
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div class="border border-slate-200 rounded-3xl p-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Kriteria Harga</h3>
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50">
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Pilihan</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Range Harga</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Murah</td>
                                    <td class="py-3 px-3">10k - 15k</td>
                                    <td class="py-3 px-3">3</td>
                                </tr>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Sedang</td>
                                    <td class="py-3 px-3">16k - 20k</td>
                                    <td class="py-3 px-3">2</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-3">Mahal</td>
                                    <td class="py-3 px-3">21k - 25k</td>
                                    <td class="py-3 px-3">1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="border border-slate-200 rounded-3xl p-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Kriteria Jarak</h3>
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50">
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Pilihan</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Range Jarak</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Dekat</td>
                                    <td class="py-3 px-3">&lt; 1 km</td>
                                    <td class="py-3 px-3">3</td>
                                </tr>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Sedang</td>
                                    <td class="py-3 px-3">1 km - 3 km</td>
                                    <td class="py-3 px-3">2</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-3">Jauh</td>
                                    <td class="py-3 px-3">&gt; 3 km</td>
                                    <td class="py-3 px-3">1</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="border border-slate-200 rounded-3xl p-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Kriteria Wifi</h3>
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50">
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Pilihan</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Kecepatan Wifi</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Lambat</td>
                                    <td class="py-3 px-3">&lt; 10 Mbps</td>
                                    <td class="py-3 px-3">1</td>
                                </tr>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Sedang</td>
                                    <td class="py-3 px-3">11 Mbps - 20 Mbps</td>
                                    <td class="py-3 px-3">2</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-3">Cepat</td>
                                    <td class="py-3 px-3">&gt; 21 Mbps</td>
                                    <td class="py-3 px-3">3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="border border-slate-200 rounded-3xl p-6">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Kriteria Parkiran</h3>
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50">
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Pilihan</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Luas Parkiran</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Sempit</td>
                                    <td class="py-3 px-3">&lt; 5 m</td>
                                    <td class="py-3 px-3">1</td>
                                </tr>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Sedang</td>
                                    <td class="py-3 px-3">6 m - 10 m</td>
                                    <td class="py-3 px-3">2</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-3">Luas</td>
                                    <td class="py-3 px-3">&gt; 11 m</td>
                                    <td class="py-3 px-3">3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="border border-slate-200 rounded-3xl p-6 md:col-span-2">
                        <h3 class="text-xl font-bold text-slate-900 mb-4">Kriteria Suasana</h3>
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200 bg-slate-50">
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Pilihan</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Kondisi</th>
                                    <th class="py-3 px-3 text-left text-slate-900 font-bold">Bobot</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Tidak Nyaman</td>
                                    <td class="py-3 px-3">Berisik</td>
                                    <td class="py-3 px-3">1</td>
                                </tr>
                                <tr class="border-b border-slate-100">
                                    <td class="py-3 px-3">Sedang</td>
                                    <td class="py-3 px-3">Agak Tenang</td>
                                    <td class="py-3 px-3 ">2</td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-3">Nyaman</td>
                                    <td class="py-3 px-3">Tenang</td>
                                    <td class="py-3 px-3">3</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
