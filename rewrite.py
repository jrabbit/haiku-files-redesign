from bottle import route, run, static_file, debug, template, default_app, request
import os
import datetime
import paragraphs

#http://pypi.python.org/pypi/hurry.filesize
import hurry.filesize

@route('/anyboot')
def anyboot():
    return index('anyboot')    

@route('/raw')
def raw():
    return index('raw')

@route('/vmware')
def vmware():
    return index('vmware')
    
@route('/cd')
def cd():
    return index('cd')

@route('/css/:filename#.+#')
def css_static(filename):
    return static_file(filename, root='./css')
    
@route('/js/:filename')
def js_static(filename):
    return static_file(filename, root='./js')

def index(location):
    htmls = """"""
    for item in filelist(location):
        archiv = "http://haiku-files.org/images/bz2.png"
        htmls = htmls + "<tr class='file-item'> <td> <img class='icon' src='%(folder)s' alt='Archive' /> </td> <td class='item'> <a href='%(srclink)s'> %(srcname)s </a> </td> <td class='item'> <a href='%(srclink)s'> %(size)s </a> </td> <td class='item'> <a href='%(srclink)s'> %(date)s </a> </td> </tr>" \
        %  {'folder' : archiv, 'srclink': "http://haiku-files.org" + item['name'], 'srcname': item['name'], 'size': item['size'], 'date': item['date'] }        
    #http://haiku-files.org/raw/haiku-nightly-r41256-x86gcc4hybrid-raw.zip
    instructions = paragraphs.instructions[location]
    return template('files.tpl', instructions = instructions, htmls = htmls, location= location  )

def filedict(location):
    for x in os.listdir('./%s' % location):
        if x[0] is not '.':
            fullname = os.path.join(os.getcwd(), location, x)
            date = datetime.datetime.fromtimestamp(os.path.getctime(fullname))
            yield {'name': x, 'size':  hurry.filesize.size(os.path.getsize(fullname)), 'date': date}


@route('/:location')
def filelist(location):
    lst = [x for x in filedict(location)]
    lst.sort(reverse=True)
    return lst

if __name__ == "__main__":
    debug(True)
    run(host='localhost', port=8080, reloader=True)
