
var insight_servers = {
    'livenet': ["https://www.localbitcoinschain.com/", "https://search.bitaccess.co/"],
    'testnet': ["https://test-insight.bitpay.com/"]
}
var insight_apis = {
    'livenet': ["https://insight.bitpay.com/api", "https://www.localbitcoinschain.com/api", "https://search.bitaccess.co/insight-api"],
    'testnet': ["https://test-insight.bitpay.com/api"]
}

console.log('initialize klukt')

var generate_txid = function () {
    var text = "";
    var possible = "ABCDEFGHJKLMNPQRSTUVWXYZ1234567890";
  
    for (var i = 0; i < 15; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
  
    return text;
  }
  
var random_selected = 0

window.klukt = {
    capitalize: function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
      },      
    render: function(element, opts,paymentcb, cb) {
        console.log('render:', element)
        var metadata = []
        window.klukt.txid = generate_txid()
        opts.txid = window.klukt.txid
        Object.keys(opts).forEach(function(eachkey) {
            if(eachkey){
                metadata.push(eachkey+'='+opts[eachkey])
            }
        })
        console.log('metadata', metadata)
        document.querySelectorAll(element)[0].innerHTML = '<iframe src="https://www.klukt.com/widget.html?' + metadata.join('&') + '" scrolling="" frameborder="0" style="background-color: white;border:1px solid #ddd;border-radius:5px;box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;" width="240" height="300"></iframe>'
        window.klukt.init(metadata.join('&'), function(result){
          console.log('init result', result)  
          if(cb) cb(result)
        }, function(payment){
            var alldata = opts
            console.log('render:payment', JSON.stringify(payment, null, 2))
            Object.keys(payment).forEach(function(payment_key){
                alldata[payment_key] = payment[payment_key]
            }) 
            console.log('render:alldata', JSON.stringify(payment, null, 2))
            
            // alldata['txid'] = payment['metadata']['txid']
            paymentcb(alldata)
        })
    },
    get: function (url, cb) {
        var r = new XMLHttpRequest();
        r.open("GET", url, true);
        r.onreadystatechange = function () {
            if (r.readyState != 4 || r.status != 200) return;
            if (cb) cb(JSON.parse(r.responseText))
        };
        r.send();
    },
    // reconnect: function(){
    //     window.klukt.connected = false
    //     window.klukt.connect()
    // },
    // connect: function(payload, cb){
    //     console.log(payload)
    //     var connect_to = insight_servers[payload.livenet][Math.floor(Math.random()*insight_servers[payload.livenet].length)]
    //     window.klukt.socket = io.connect(connect_to);
    //     if(!window.klukt.connected){
    //         window.klukt.socket.on('connect', function (data) {
    //             window.klukt.connected = true
    //             window.klukt.socket.on('disconnect', window.klukt.reconnect)
    //             window.klukt.socket.on('error', window.klukt.reconnect)
    //             if (cb) cb(window.klukt.socket)
    //         })
    //     } else {
    //         cb(window.klukt.socket)
    //     }
    // },
    pool: function(payload, cb) {
        console.log('<pool>', insight_apis, payload)
        var pool_interval = setInterval(function(){
            // insight_servers[payload.livenet].forEach(function(each_insight_server) {
                //Math.floor(Math.random()*insight_apis[payload.livenet].length)
                random_selected++
                if(random_selected >= insight_apis[payload.livenet].length){
                    random_selected = 0
                }
                console.log('random_selected', random_selected)
                window.klukt.get(insight_apis[payload.livenet][random_selected]+'/txs/?address='+payload.address, function(result){
                    if(result && result.txs.length > 0){
                        window.klukt.get("https://api.klukt.com/verify?address="+payload.address+'&preventCache='+new Date().getTime(), function(response){
                            cb(payload)
                            clearInterval(pool_interval)
                        })
                    }
                })
            // })
        }, 3 * 1000)
    },
    init: function (params, initedcb, cb) {
        setTimeout(function(){
            window.klukt.get('https://api.klukt.com/widget?'+params, function(payload){
                console.log('widget init...', payload)
                initedcb(payload)
                payload.txid = window.klukt.txid
                console.log('-initialized widget:', payload)
                window.klukt.pool(payload, function(payload){
                    cb(payload)
                })
                // window.klukt.connect(payload, function(socket){
                //     socket.emit('subscribe', 'inv');
                //     socket.on('tx', function (tx) {
                //         tx.vout.forEach(function (each_vout) {
                //             if (Object.keys(each_vout).indexOf(payload.address) > -1) {
                //                 if(cb) {
                //                     delete payload['qr']
                //                     delete payload['url']
                //                     cb(payload)
                //                 }
                //             }
                //         })
                //     });
                // })
            })
        }, 100)
    }
}