<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Desafio Backend') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Insira o <i>symbol</i> da empresa para visualizar as informações das ações.
                    <p class="text-slate-500 group-hover:text-white text-sm">Por exemplo: aapl (Apple), meta (Facebook), twtr (Twitter), amzn (Amazon), nflx (Netflix).</p>

                    <form id="submit" action="{{ route('api.company') }}" method="get">

                        <label class="block">
                            <input id="symbol-input" type="text" name="symbol" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Insira aqui" />
                        </label>

                        <div class="p-2">
                            <button type="submit" class="group relative flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Procurar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="result" class="py-1" style="display: none;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="px-2 py-2 sm:px-6">
                    <h3 class="text-lg font-medium leading-6 text-gray-900"><span id="companyName"></span> (<span id="symbol"></span>)</h3>
                    <p class="mt-1 max-w-2xl text-xs text-gray-500"><span id="primaryExchange"></span> - Currency in <span id="currency"></span></p>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500"><span id="description"></span></p>
                </div>
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-10 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Latest Price</dt>
                            <dd class="text-sm">R$<span id="latestPrice"></span> <span id="change"></span> (<span id="changePercent"></span>)</dd>
                        </div>
                        <div class="bg-white px-4 py-1 sm:grid sm:grid-cols-10 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">Latest Price Updated</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"><span id="latestUpdate"></span></dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-1 sm:grid sm:grid-cols-10 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">CEO</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"><span id="ceo"></span></dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $('body').on('submit', '#submit', function(e) {
        e.preventDefault();

        let endpoint = $(this).attr('action'),
            form = $(this).serialize();

        $.ajax({
            url: endpoint,
            method: 'GET',
            dataType: 'json',
            data: form,
            cache : false,
            processData: false,
            success: function (xhr) {
                if (xhr) {
                    $('#result').fadeIn(500);
                    $('#symbol').html(xhr.info.symbol);
                    $('#companyName').html(xhr.info.companyName);
                    $('#description').html(xhr.info.description);
                    $('#ceo').html(xhr.info.ceo);
                    $('#latestPrice').html(xhr.quote.latestPrice);
                    $('#latestUpdate').html(xhr.quote.lastUpdate);
                    $('#currency').html(xhr.quote.currency);
                    $('#primaryExchange').html(xhr.quote.primaryExchange);
                    $('#change').html(xhr.quote.change && Math.sign(xhr.quote.change) > 0 ? '+ ' + xhr.quote.change : '- ' + xhr.quote.change);
                    $('#changePercent').html(Number(xhr.quote.changePercent * 100).toFixed(2) + ' %');
                }
            }
        })
    });
</script>
