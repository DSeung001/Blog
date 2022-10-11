- npm install 시 아래 에러가 발생할 경우 <br/>
=> npm ERR! EPROTO: protocol error, symlink '../esbuild/bin/esbuild' -> '/home/vagrant/code/blog/laravel-chat/node_modules/.bin/esbuild'

- 해결책 <br/> 
=> npm install --no-bin-links
