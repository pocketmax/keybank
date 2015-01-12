var yaml = require('yamljs');
var exec = require('exec-sync');
var _ = require('lodash');

var data = yaml.load('sample1.yaml');

var createRootCertificate = function(cfg){

    cfg.outFile = cfg.outFile || 'certificates/root.crt';
    var cmd =
        "openssl genrsa " +
        '-out ' + cfg.outFile +
        ' ' + cfg.bits
    ;
    exec(cmd, true);

};

createRootCertificate(data.certificates.root);
