from bottle import route, run, static_file, debug, template, default_app, request
import os
import datetime
import paragraphs

@route('/anyboot')
def anyboot():
    
@route('/raw')
def raw():
    
@route('/vmware')
def vmware():
    
    
@route('/cd')
def cd():


def index(location):
    htmls
    instructions = paragraphs.instructions[location]
    return template('files.tpl', )

def filedict(location):
    for x in os.listdir('./%s' % location):
        if x[0] is not '.':
            name = os.path.join(os.getcwd(), x)
            date = datetime.datetime.fromtimestamp(os.path.getctime(name))
            yield {'name': name, 'size':  os.path.getsize(name), 'date': date}


@route('/')
def filelist(location):
    lst = [x for x in filedict(location)]
    lst.sort(reverse=True)
    return lst

