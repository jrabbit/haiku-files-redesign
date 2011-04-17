from bottle import route, run, static_file, debug, template, default_app, request
import os
import datetime
import paragraphs

#http://pypi.python.org/pypi/hurry.filesize
import hurry.filesize

@route('/anyboot')
def anyboot():
    index('anyboot')    

@route('/raw')
def raw():
    index('raw')

@route('/vmware')
def vmware():
    index('vmware')
    
@route('/cd')
def cd():
    index('cd')

def index(location):
    htmls = """"""
    for item in filelist(location):
        archiv = "http://haiku-files.org/images/bz2.png"
        htmls = htmls + """<tr class="file-item">
        	<td> <img class="icon" src="%(folder)s" alt="Archive" /> </td>
        	<td class='item-data'> <a href="%(src-link)s"> %(src-name)s </a> </td>
        	<td class='item-data'> <a href="%(src-link)s"> %(size)s </a> </td>
        	<td class='item-data'> <a href="%(src-link)s"> %(date)s </a> </td>
        </tr>""" \
        %  {'folder' : archiv, 'src-link': "http://haiku-files.org" + item['name'], 'src-name': item['name'], 'size': item['size'], 'date': item['date'] }
        print htmls
        
    #http://haiku-files.org/raw/haiku-nightly-r41256-x86gcc4hybrid-raw.zip
    instructions = paragraphs.instructions[location]
    return template('files.tpl', instructions = instructions  )

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
